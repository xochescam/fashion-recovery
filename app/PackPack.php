<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use Session;
use Redirect;
use Mail;

use App\Mail\ErrorPackPack;

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

    public static function key($response, $url) {

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

    public static function tracking($PackPackID) {

        $user = PackPack::login();

        if($user->getStatusCode() !== 200) {
            return $user->getStatusCode();
        } 

        $data = PackPack::validateKey($user);

        if($data->getStatusCode() !== 200) {
            return $data->getStatusCode();
        }

        $url  = '/orders';    
        $key     = PackPack::key($data, $url);
        $user_id = json_decode($data->getBody())->data->user_id;

        $client = new Client(); 
        $response = $client->request(
            'GET',
            'https://pp-users-integrations-api-prod.herokuapp.com/orders/'.$PackPackID,
            [
                'headers' => [
                    'user_id' => $user_id,
                    'token' => $key,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        $res = json_decode($response->getBody())->data;

        $history = collect($res->shipment->statusHistory);
        $places = $res->shipment->places;
        $pickup = [
            'status' => 'Origen',
            'location'  => $places->pickup->address->state,
            'date'   => PackPack::formatDate("d F Y", $res->created) 
        ];
        $delivery = [
            'status' => 'Destino',
            'location' => $places->delivery->address->state,
        ];
        
        if($res->status === 'placed') {
            $map = [];
            $delivery['date'] = '¡El pedido se ha entregado!';

            array_unshift($map, $pickup);
            array_push($map, $delivery);

        } else {

            $map = $history->map(function ($item) use ($history){

                return [
                    'status' => $item->name,
                    'location' => ucwords(strtolower($item->comment)),
                    'date' => PackPack::formatDate("d F Y", $item->date) 
                ];
            })->toArray();
    
            array_unshift($map, $pickup);
            array_push($map, $delivery);
        }
        
        return [
            'map' => $map,
            'status' => $res->status
        ];
    } 

    public static function formatDate($format, $date) {

        $date    = date($format, strtotime($date));
        $explode = explode(" ", $date);
        $format = [];

        $months = [
                'January'   =>'enero',
                'February'  =>'febrero',
                'March'     =>'marzo',
                'April'     =>'abril',
                'May'       =>'Mayo',
                'June'      =>'junio',
                'July'      =>'julio',
                'August'    =>'agosto',
                'September' =>'septiembre',
                'October'   =>'octubre',
                'November'  =>'noviembre',
                'December'  =>'diciembre',
            ];

        return $explode[0].' de '.$months[$explode[1]].' '.$explode[2];
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
            
            $key     = PackPack::key($data, $url);
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
                        'delivery_zip_code' => $delivery, //01030
                        'pickup_zip_code' => $pickup, //34030
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
