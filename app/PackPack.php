<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Session;
use Redirect;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\User;

class PackPack extends Model
{
    public static function login() {
        
        $client = new Client();
        
        return $client->request('POST', 
        'https://pp-users-integrations-api-prod.herokuapp.com/signin/email',
        [
            'form_params' => [
                    'email' => env('ALGOLIA_EMAIL'),
                    'password' => env('ALGOLIA_PASSWORD')
                
            ]
        ]);
    }

    public static function key($response, $url, $body) {

        $userData = json_decode($response->getBody());
        
        $key    = $userData->data->key;
        $result =$response->getBody().$url.$key;
        $hash   = hash('sha256', $result);

        return $hash;
    }

    public static function validateKey($user) {
        
        $userData = json_decode($user->getBody());

        $client = new Client(); 
        return $client->request('GET', 'https://pp-users-integrations-api-prod.herokuapp.com/keys/'.$userData->key->_id.'/verify');
    }

    public static function quotation($delivery) {

        $user = PackPack::login();

        if($user->getStatusCode() !== 200) {
            return $user->getStatusCode();
        } 

        $data = PackPack::validateKey($user);

        if($data->getStatusCode() !== 200) {
            return $data->getStatusCode();
        }

        $userIds = Auth::User()->getItems()
                        ->groupBy('UserID')->keys();
        
        $pickups = Address::whereIn('UserID',$userIds)->get(['ZipCode']);

        return $pickups->sum(function ($item) use ($delivery, $data){
           
            $pickup = $item->ZipCode;
            $url  = '/quotation/native';
            $body = '{"delivery_zip_code":'.$delivery.',"pickup_zip_code":'.$pickup.',"type":"package","insurance":0,"size":{"width":32,"height":33,"deep":18,"weight":4}}';
            
            $key     = PackPack::key($data, $url, $body);
            $user_id = json_decode($data->getBody())->data->user_id;

            $client = new Client(); 
            $response = $client->request(
                'POST',
                'https://pp-users-integrations-api-prod.herokuapp.com/quotation/native',
                [
                    'headers' => [
                        'user_id' => $user_id,
                        'token' => $key,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'delivery_zip_code' => $delivery,
                        'pickup_zip_code' => $pickup,
                        'type' => 'package',
                        'insurance' => 0,
                        "size" => [
                            "width" => 32,
                            "height" => 33,
                            "deep" => 18,
                            "weight" => 4
                        ]
                    ]
                ]
            );

            $res = json_decode($response->getBody())->data;
            $ordered = array_sort($res, 'price', SORT_ASC);
            return $ordered[0]->price - 60;
        });
    }
}
