<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Image;

use App\Devolution;


class ShoppingCartController extends Controller
{
    protected $table = 'fashionrecovery.GR_041';

    public function addItem($ItemID) {

        $item = $this->getItem($ItemID);

        if(!isset($item->ItemID)) {

            return response()->json([
                'message' => $item['message'], 
                'response' => 'warning'
            ]);
        }

        if ($this->existsInCart($ItemID)) {

            return response()->json([
                'message' => 'La prenda ya está en el carrito.', 
                'response' => 'warning'
            ]);
        }

        DB::beginTransaction();

        try {

            DB::table($this->table)
                ->insert($this->getData($ItemID));

            DB::commit();

            return response()->json([
                'message' => 'Prenda agregada al carrito.', 
                'response' => 'success'
            ]);

        } catch (\Exception $ex) {

            DB::rollback();

            return response()->json([
                'message' => 'Ha ocurrido un error, inténtalo nuevamente.', 
                'response' => 'warning'
            ]);
        }
    }

    public function deleteItem($ItemID) {

        DB::beginTransaction();

        try {

            DB::delete('DELETE FROM fashionrecovery."GR_041" WHERE "ItemID"='.$ItemID.'AND "UserID"='.Auth::User()->id);

            DB::commit();

            return response()->json([
                'message' => 'Se ha eliminado correctamente la prenda del carrito.', 
                'response' => 'success'
            ]);

        } catch (\Exception $ex) {

            DB::rollback();

            return response()->json([
                'message' => 'Ha ocurrido un error, inténtalo nuevamente.', 
                'response' => 'warning'
            ]);
        }
    }

    public function items() {

        $items      = Auth::User()->getItems();
        $subtotal   = Auth::User()->getTotal();
        $devTotal   = null;
        $total      = $subtotal;

        $devolution = Devolution::where('UserID',Auth::User()->id)->get();

        if(count($devolution) > 0) {

            $devTotal = $devolution->sum(function ($item) {
                return str_replace(',', '', substr($item->Amount, 1));
            });

            $total = $devTotal > $subtotal ? 0 : $subtotal - $devTotal;
        }         

        return view('shopping-cart.items',compact('items','total','subtotal','devTotal'));
    }

    public function getItem($ItemID) {

        $item = DB::table('fashionrecovery.GR_029')
                        ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                        ->where('GR_029.ItemID',$ItemID)
                        ->select('GR_029.ItemID',
                                 'GR_029.OffSaleID',
                                 'GR_029.ItemDescription',
                                 'GR_029.OriginalPrice',
                                 'GR_029.ActualPrice',
                                 'GR_029.SizeID',
                                 'GR_029.BrandID',
                                 'GR_032.PicturePath',
                                 'GR_032.ThumbPath',
                                 'GR_029.OwnerID'
                             )->get()->first();

        if(!isset($item)) {
            return [
                'message' => 'La prenda no está disponible.'
            ];

        } else if($item->OwnerID === Auth::User()->id){

            return [
                'message' => 'No puedes adquirir una prenda de tu colección.'
            ];
        }

        $item->BrandID = $this->getBrand($item);
        $item->SizeID  = $this->getSize($item);


        return $item;
    }

    public function getBrand($item) {

        return isset($item->BrandID) ? 
                DB::table('fashionrecovery.GR_017')
                    ->where('BrandID',$item->BrandID)
                    ->first()->BrandName : 
                DB::table('fashionrecovery.GR_036')
                    ->where('ItemID',$item->ItemID)
                    ->first()->OtherBrand;
    }

    public function getSize($item) {

        return isset($item->BrandID) ? 
                DB::table('fashionrecovery.GR_020')
                    ->where('SizeID',$item->SizeID)
                    ->first()->SizeName : 
                DB::table('fashionrecovery.GR_036')
                    ->where('ItemID',$item->ItemID)
                    ->first()->OtherSize;
    }

    public function existsInCart($ItemID) {

        $exist = DB::table($this->table)
                    ->where('ItemID',$ItemID)
                    ->where('UserID',Auth::User()->id)
                    ->get();

        return count($exist) > 0 ? true : false;
    }

    public function getData($ItemID) {

        return [
            'UserID'       => Auth::User()->id,
            'ItemID'       => $ItemID,
            'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
