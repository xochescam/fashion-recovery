<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Image;


class ShoppingCartController extends Controller
{
    protected $table = 'fashionrecovery.GR_041';

    public function addItem($ItemID) {

        $item = $this->getItem($ItemID);

        if(!isset($item->ItemID)) {

            Session::flash('warning',$item['message']);
            return Redirect::back();
        }

        if ($this->existsInCart($ItemID)) {

            Session::flash('warning','La prenda ya está en el carrito.');
            return Redirect::back();
        }

        DB::beginTransaction();

        try {

            DB::table($this->table)
                ->insert($this->getData($ItemID));

            DB::commit();

            Session::flash('success','Prenda agregada al carrito.');
            return Redirect::back();

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::back();
        }
    }

    public function deleteItem($ShoppingCartID, $url) {

        $explode = explode('-',$url);

        if($explode[0] == 'summary') {

            $items = Auth::User()->getItems();

            $url = count($items) == 1 ? 'cart' : $explode[0].'/'.$explode[1];
        }

        DB::beginTransaction();

        try {

            DB::delete('DELETE FROM fashionrecovery."GR_041" WHERE "ShoppingCartID"='.$ShoppingCartID);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente la prenda del carrito.');

            return Redirect::to($url);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to($url);
        }
    }

    public function items() {

        $items = Auth::User()->getItems();

        return view('shopping-cart.items',compact('items'));
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

        return DB::table($this->table)
                    ->where('ItemID',$ItemID)
                    ->where('UserID',Auth::User()->id)
                    ->first();
    }

    public function getData($ItemID) {

        return [
            'UserID'       => Auth::User()->id,
            'ItemID'       => $ItemID,
            'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
