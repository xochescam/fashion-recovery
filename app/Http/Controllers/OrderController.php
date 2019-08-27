<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;

class OrderController extends Controller
{
	protected $table = 'fashionrecovery.GR_021';
	protected $detail = 'fashionrecovery.GR_022';


    public function index() { //ordenar pedidos por usuarios

        $orders    = null;
        $pending   = null;
        $finalized = null;
        $canceled  = null;
    	$user      = Auth::User();

    	$orders = DB::table($this->table)
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
                             'GR_001.Alias',
                             'GR_022.OrderID'
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
}
