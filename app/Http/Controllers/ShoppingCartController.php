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
    public function addItem($ItemID) {

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
	                              'GR_032.ThumbPath'
	                         )->get()->first();

        if(isset($item->BrandID)) {

            $brand = DB::table('fashionrecovery.GR_017')
                                ->where('BrandID',$item->BrandID)
                                ->first()->BrandName;

            $size  = DB::table('fashionrecovery.GR_020')
                                ->where('SizeID',$item->SizeID)
                                ->first()->SizeName;

            $item->BrandID = $brand;
            $item->SizeID  = $size;

        } else {

            $otherBrand = DB::table('fashionrecovery.GR_036')
                            ->where('ItemID',$item->ItemID)
                            ->first();

            $item->BrandID = $otherBrand->OtherBrand;
            $item->SizeID  = $otherBrand->$OtherSize;
        }

        Session::flash('success','Has agregado un elemento al carrito de compras.');
    	return view('shopping-cart.items',compact('item'));
    }
}
