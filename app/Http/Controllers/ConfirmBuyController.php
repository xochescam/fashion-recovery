<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ConfirmBuyController extends Controller
{
    
    public function confirm($ShippingAddID) {

        $address = Auth::User()->getShippingAddress()
                            ->where('ShippingAddID',$ShippingAddID)
                            ->first();
        $items = Auth::User()->getItems();

        $userIds = $items->groupBy('UserID')->keys();

        $addressSellers = DB::table('fashionrecovery.GR_002')
                    ->whereIn('UserID',$userIds)
                    ->get();

        if(count($userIds) === count($addressSellers)) {

            return response()->json($this->login());
        }
        
        
        //GUARDAR EN UN QUEUE

        //Datos de las prendas (id's, id del o los vendedores, cp de los vendedores, ) *
        //Direccion de los vendedores *
        //Login
        //Token
        //Verificar

        //FOREACH
        //Cotizar 
        //Elegir el envio más barato 
        //Enviar
        //Guardar en la bd la compra, el estatus de la prenda...

        return response()->json($addressUsers);
    }

    public function login() {
        
        $client = new Client();
        
        $response = $client->request('POST', 
        'https://pp-users-integrations-api-prod.herokuapp.com/signin/email',
        [
            'form_params' => [
                    'email' => env('ALGOLIA_EMAIL'),
                    'password' => env('ALGOLIA_PASSWORD')
                
            ]
        ]);


        if($response->getStatusCode() === 200) {

            $this->quotation($response);

        } else {
            dd('Error en login :'.$response->getStatusCode());
        }
    }

    public function key($response, $url, $body) {

        $userData = json_decode($response->getBody());
        
        $key    = $userData->data->key;
        $result =$response->getBody().$url.$key;
        $hash   = hash('sha256', $result);

        return $hash;
    }

    public function validateKey($user) {
        
        $userData = json_decode($user->getBody());

        $client = new Client(); 
        $response = $client->request('GET', 'https://pp-users-integrations-api-prod.herokuapp.com/keys/'.$userData->key->_id.'/verify');

        if($response->getStatusCode() === 200) {

            return $response;

        } else {

            return false;
            dd('Error en validateKey: '.$response->getStatusCode());
        }
    }

    public function quotation($user) {

        $key  = '';
        $url  = '/quotation/native';
        $body = '{"delivery_zip_code":34030,"pickup_zip_code":34030,"type":"package","insurance":0,"size":{"width":32,"height":33,"deep":18,"weight":4}}';
        $data = $this->validateKey($user);

        if(!$data) {
            return $data;
        }

        $key     = $this->key($data, $url, $body);
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
                    'delivery_zip_code' => '34030',
                    'pickup_zip_code' => '34040',
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



        dd(json_decode($response->getBody())->data);

        if($response->getStatusCode() === 200) {

            return $response;

        } else {

            return false;
            dd('Error en validateKey: '.$response->getStatusCode());
        }
    }
}
