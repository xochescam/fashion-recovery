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
        'https://pp-users-integrations-api-test.herokuapp.com/signin/email',
        [
            'form_params' => [
                    'email' => 'heavyjra@gmail.com',
                    'password' => 'F12345678R'
                
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
        $result = $body.$url.$key;
        $hash   = hash('sha256', $result);

        return $hash;
    }

    public function validateKey($user) {
        
        $userData = json_decode($user->getBody());

        $client = new Client(); 
        $response = $client->request('GET', 'https://pp-users-integrations-api-test.herokuapp.com/keys/'.$userData->key->_id.'/verify');

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
        $body = '{"delivery_zip_code":72000,"pickup_zip_code":75763,"type":"package","insurance":10,"size":{"width":10,"height":10,"deep":2,"weight":10}}';
        $data = $this->validateKey($user);

        if(!$data) {
            return $data;
        }

        $key     = $this->key($data, $url, $body);
        $user_id = json_decode($data->getBody())->data->user_id;

        dd($body);

        $client = new Client(); 
        $response = $client->request('POST', 
        'https://pp-users-integrations-api-test.herokuapp.com/quotation/native',[
            'headers' => [
                "Content-Type" => "application/json",
                'user_id' => $user_id,
                'token' => $key
            ],
            'form_params' => [
                $body
            ]
        ]);

        dd($response);

        if($response->getStatusCode() === 200) {

            return $response;

        } else {

            return false;
            dd('Error en validateKey: '.$response->getStatusCode());
        }
    }
}
