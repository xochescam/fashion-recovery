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

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->where('GR_032.IsCover',true)
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->select('GR_032.ThumbPath','GR_029.ItemID')
                    ->count();

        $seller = DB::table('fashionrecovery.GR_001')
                    ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')
                    ->where('GR_001.Alias',Auth::User()->Alias)
                    ->where('GR_001.Confirmed',1)
                    ->where('GR_001.ProfileID',2)
                    ->select('GR_001.Alias',
                             'GR_001.Name',
                             'GR_001.Lastname',
                             'GR_033.Greeting',
                             'GR_033.AboutMe',
                             'GR_033.LiveIn',
                             'GR_033.WorkIn',
                             'GR_033.TotalEvaluations',
                             'GR_033.ItemsSold',
                             'GR_033.ItemsReturned',
                             'GR_033.Ranking',
                             'GR_033.SelfiePath',
                             'GR_033.SelfieThumbPath',
                             'GR_001.id',
                             'GR_033.SellerSince',
                             'GR_033.UserID',
                             'GR_033.Phone',
                             'GR_033.IdentityDocumentPath')
                    ->first();

                    $sellerSince = $this->formatDate("d F Y", $seller->SellerSince);

    	return view('sells.index',
            compact(
                    'pending',
                    'finalized',
                    'canceled',
                    'sells',
                    'seller',
                    'items',
                    'sellerSince'));
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

    public function update(Request $request, $id) {

        DB::table('fashionrecovery.GR_021')
                ->where('OrderID',$id)
                ->update(['OrderStatusID' => $request->OrderID]);

        Session::flash('success','Se ha actualizado correctamente el estado de la venta.');
        return Redirect::to('sells');
    }
}
