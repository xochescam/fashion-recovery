<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Gate;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class OrderController extends Controller
{
	protected $table = 'fashionrecovery.GR_021';
	protected $detail = 'fashionrecovery.GR_022';


    public function index() { //ordenar pedidos por usuarios

        if (Gate::denies('show-orders')) {
            abort(403);
        }

        $orders    = null;
        $pending   = null;
        $finalized = null;
        $canceled  = null;
    	$user      = Auth::User();

    	$orders = DB::table($this->table)
                    //->join('fashionrecovery.GR_022', 'GR_021.OrderID', '=', 'GR_022.OrderID')
                    ->join('fashionrecovery.GR_013', 'GR_021.OrderStatusID', '=', 'GR_013.OrderStatusID')
                    ->where('UserID',Auth::User()->id)
                    ->select('GR_021.TotalAmount','GR_021.OrderID','GR_013.Name','GR_021.NoOrder')
                    ->get();

        $pending   = $orders->where('Name','!==','Entregado')
                            ->where('Name','!==','Cancelado')
                            ->where('Name','!==','Solicitado'); 
        $finalized = $orders->where('Name','Entregado'); 
        $canceled  = $orders->where('Name','Cancelado');  
        
        $keys = $orders->groupBy('OrderID')->keys();

		$items = DB::table($this->detail)
		            ->join('fashionrecovery.GR_029', 'GR_022.ItemID', '=', 'GR_029.ItemID')
                   	->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->whereIn('GR_022.OrderID',$keys)
                    ->select('GR_029.ItemID',
                             'GR_029.ItemDescription',
                             'GR_029.SizeID',
                             'GR_029.BrandID',
                             'GR_001.Alias',
                             'GR_022.OrderID',
                             'GR_022.GuideID',
                             'GR_022.PackingOrderID',
                             'GR_022.FolioID',
                             'GR_022.GuideURL'
                    )->get();
                    
        $items = $items->map(function ($item, $key) use ($user){

            $item->ThumbPath = $user->getThumbPath($item);
            $item->BrandID   = $user->getBrand($item);
            $item->SizeID    = $user->getSize($item);

            return $item;

        })->groupBy('OrderID');

    	return view('orders.index',
            compact('orders',
                    'pending',
                    'finalized',
                    'canceled',
                    'items'));
    }

    public function cancel($GuideID) {

        $data = $this->login();
        $url  = '/orders/cancel/';
        $body = '{}';
        $key  = '';

        if($data->success) {

            $key = $this->key($data, $url, $body);

            $client = new Client();

            $response = $client->request('PUT', 
            'https://pp-users-integrations-api-test.herokuapp.com'.$url.$GuideID,[
                'headers' => [
                    'user_id' => $data->data->user_id,
                    'token' => $key
                ]
            ]);

            $orderId = DB::table('fashionrecovery.GR_022')
                ->where('PackingOrderID','=',$GuideID)
                ->update(["OrderStatusID" => 6]);
            

                    ;

            return response()->json($response->getStatusCode());
        }

    }

    public function login() {

        $res = '';
        $client = new Client();
        
        $response = $client->request('POST', 
        'https://pp-users-integrations-api-test.herokuapp.com/signin/email',
        [
            'form_params' => [
                    'email' => 'heavyjra@gmail.com',
                    'password' => 'F12345678R'

            ]
        ]);

        if($response->getStatusCode() == 200) {
            $res = $this->validateKey($response);
        }

        return $res->success ? $res : json_decode($response->getBody())->success;
    }

    public function key($response, $url, $body) {
        
        $key    = $response->data->key;
        $result = $body.$url.$key;
        $hash   = hash('sha256', $result);

        return $hash;
    }

    public function validateKey($user) {
        
        $userData = json_decode($user->getBody());

        $client = new Client(); 
        $response = $client->request('GET', 'https://pp-users-integrations-api-test.herokuapp.com/keys/'.$userData->key->_id.'/verify');

        return json_decode($response->getBody());
    }
}
