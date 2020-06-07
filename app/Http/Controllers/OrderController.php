<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Gate;

use App\Order;
use App\InfoOrder;
use App\Item;

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
                    ->select('GR_021.TotalAmount','GR_021.OrderID','GR_013.Name')
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
                             'GR_029.ActualPrice',
                             'GR_001.Alias',
                             'GR_022.OrderID',
                             'GR_022.GuideID',
                             'GR_022.PackingOrderID',
                             'GR_022.FolioID',
                             'GR_022.GuideURL',
                             'GR_022.NoOrder',
                             'GR_022.CreationDate',
                             'GR_022.UpdateDate'
                    )->get();
                    
        $items = $items->map(function ($item, $key) use ($user){

            

            $item->ThumbPath = $user->getThumbPath($item);
            $item->BrandID   = $user->getBrand($item);
            $item->SizeID    = $user->getSize($item);
            $item->CreationDate  = $this->formatDate("d F Y", $item->CreationDate);
            $item->update        = $this->formatDate("d F Y", $item->UpdateDate);

            return $item;

        })->groupBy('OrderID');

    	return view('orders.index',
            compact('orders',
                    'pending',
                    'finalized',
                    'canceled',
                    'items'));
    }

    protected function formatDate($format, $date) {

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

    public function cancel($OrderID) {

        $info = InfoOrder::where('NoOrder',$OrderID)->first();

        $info->IsCanceled = true;
        $info->save();

        $item = Item::find($info->ItemID);
        $item->IsSold = false;
        $item->save(); 
        $item->searchable();

        $orderId = DB::table('fashionrecovery.GR_022')
                    ->where('PackingOrderID','=',$info->PackingOrderID)
                    ->update(["OrderStatusID" => 6]);

        if(isset($info->FolioID)) {

            $data = $this->login();
            $url  = '/orders/cancel/';
            $body = '{}';
            $key  = '';

            if($data->success) {

                $key = $this->key($data, $url, $body);

                $client = new Client();

                $response = $client->request('PUT', 
                'https://pp-users-integrations-api-prod.herokuapp.com'.$url.$info->PackingOrderID,[
                    'headers' => [
                        'user_id' => $data->data->user_id,
                        'token' => $key
                    ]
                ]);

                return response()->json($response->getStatusCode());
            }
        }

        return response()->json('success');
    }

    public function login() {

        $res = '';
        $client = new Client();
        
        $response = $client->request('POST', 
        'https://pp-users-integrations-api-prod.herokuapp.com/signin/email',
        [
            'form_params' => [
                'email' => env('ALGOLIA_EMAIL'),
                'password' => env('ALGOLIA_PASSWORD')

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
        $response = $client->request('GET', 'https://pp-users-integrations-api-prod.herokuapp.com/keys/'.$userData->key->_id.'/verify');

        return json_decode($response->getBody());
    }
}
