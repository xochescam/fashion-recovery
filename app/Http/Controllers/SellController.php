<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;

class SellController extends Controller
{
    public function index() { //ordenar pedidos por usuarios

        $orders    = null;
        $pending   = null;
        $finalized = null;
        $canceled  = null;
    	$user      = Auth::User();

    	$itemIds = DB::table('fashionrecovery.GR_029')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->where('GR_029.IsSold',true)
                    ->get()->groupBy('ItemID')->keys();

    	$sells = DB::table('fashionrecovery.GR_029')
                        ->join('fashionrecovery.GR_022', 'GR_029.ItemID', '=', 'GR_022.ItemID')
                        ->join('fashionrecovery.GR_021', 'GR_022.OrderID', '=', 'GR_021.OrderID')
                        ->join('fashionrecovery.GR_001', 'GR_021.UserID', '=', 'GR_001.id')
                        ->join('fashionrecovery.GR_013', 'GR_021.OrderStatusID', '=', 'GR_013.OrderStatusID')
                        ->whereIn('GR_029.ItemID',$itemIds)
                        ->select('GR_029.ItemID',
                                 'GR_029.OffSaleID',
                                 'GR_029.ItemDescription',
                                 'GR_029.OriginalPrice',
                                 'GR_029.ActualPrice',
                                 'GR_029.SizeID',
                                 'GR_029.BrandID',
                                 'GR_021.TotalAmount',
                                 'GR_001.Alias as Buyer',
                                 'GR_013.Name',
                                 'GR_022.OrderID'
                             )->get();

         $pending   = $sells->where('Name','!==','Entregado')
                             ->where('Name','!==','Cancelado')
                             ->where('Name','!==','Solicitado'); 
         $finalized = $sells->where('Name','Entregado'); 
         $canceled  = $sells->where('Name','Cancelado');           


        $sells = $sells->map(function ($item, $key) use ($user){

            $item->ThumbPath = $user->getThumbPath($item);
            $item->BrandID   = $user->getBrand($item);
            $item->SizeID    = $user->getSize($item);

            return $item;

        });

    	return view('sells.index',
            compact('pending',
                    'finalized',
                    'canceled',
                    'sells'));
    }

    public function update(Request $request, $id) {

        DB::table('fashionrecovery.GR_021')
                ->where('OrderID',$id)
                ->update(['OrderStatusID' => $request->OrderID]);

        Session::flash('success','Se ha actualizado correctamente el estado de la venta.');
        return Redirect::to('sells');
    }
}
