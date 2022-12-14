<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;
use Gate;

use App\Item;

class PaymentController extends Controller
{
    public function payment($ShippingAddID, $IsBuy) {

        $item = $this->getItem($ShippingAddID);

        if (Gate::denies('buy-item') || $item->IsSold) {
            abort(403);
        }

        $user = Auth::User();

        if($IsBuy === "true") {

            if(!isset($item->ItemID)) {
    
                Session::flash('warning',$item['message']);
                return Redirect::back();
            }
        }

        //cuando no hay direccion // pasar a agregar la dirección
        //cuando hay dirección y no hay nada en el carrito // tomar la dirección default y agregar al carrito
        //cuando hay dirección y ya hay items en el carrito // tomar la dirección default y agregar al carrito que ya tiene items
        $address = $user->getDefaultAddress() !== null ? $user->getDefaultAddress() : false;
        $addToCart  = $this->addToCart($ShippingAddID, $user);

        if (!$addToCart && $IsBuy === "true") {
            Session::flash('warning','La prenda ya está en el carrito.');
            return Redirect::back();
        }

        if($address) {

            return view('payment.index',compact('address','IsBuy','ShippingAddID'));

        } else {

            return Redirect::to('address');
        }
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
                                 'GR_029.OwnerID',
                                 'GR_029.IsSold'
                             )->get()->first();

        if(!isset($item)) {
            return [
                'message' => 'La prenda no está disponible.'
            ];

        } else if($item->OwnerID === Auth::User()->id){

            return [
                'message' => 'No puedes adquirir una prenda de tu colección.'
            ];
        } else if($item->IsSold) {
            return [
                'message' => 'La prenda ya fue vendida.'
            ];
        }

        return $item;
    }


    public function getAddress($ShippingAddID, $user) {
        return $user->getShippingAddress()
                ->where('ShippingAddID',$ShippingAddID)
                ->first();
    }

    public function addToCart($ShippingAddID, $user) {

        if ($this->existsInCart($ShippingAddID)) {

            return false;

        } else {

            DB::table('fashionrecovery.GR_041')
            ->insert([
                'UserID'       => $user->id,
                'ItemID'       => $ShippingAddID,
                'CreationDate' => date("Y-m-d H:i:s")
            ]);

            return true;
        }

    }

    public function existsInCart($ItemID) {

        return DB::table('fashionrecovery.GR_041')
                    ->where('ItemID',$ItemID)
                    ->where('UserID',Auth::User()->id)
                    ->first();
    }

    public function summary($ShippingAddID) {

        if (Gate::denies('buy-item')) {
            abort(403);
        }

        $items   = Auth::User()->getOrdered();
        $address = Auth::User()->getShippingAddress()
                                ->where('ShippingAddID',$ShippingAddID)
                                ->first();

        return view('payment.confirmation',compact('items','address'));
    }

    public function confirmation($ShippingAddID) {

        if (Gate::denies('buy-item')) {
            abort(403);
        }

        $user    = Auth::User();
        $items   = $user->getItems();
        $arrayIt = []; 

        DB::table('fashionrecovery.GR_021')
            ->insert([
                'UserID'          => $user->id,
                'OrderStatusID'   => 3,
                'ShippingID'      => $ShippingAddID,
                'TotalAmount'     => Auth::User()->getTotal(), //agregar lo del envío
                'PaymentOptionID' => 2, //agregar lo del pago
                'CreationDate' => date("Y-m-d H:i:s")
            ]);


        $last = DB::table('fashionrecovery.GR_021')
                    ->where('UserID',$user->id)
                    ->orderBy('CreationDate', 'desc')
                    ->first()
                    ->OrderID;

        $s = strtoupper(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5));

        DB::table('fashionrecovery.GR_021')
            ->where('OrderID',$last)
            ->update([
                'NoOrder' => $s.$last,
            ]);

        foreach ($items as $key => $value) {

            DB::table('fashionrecovery.GR_022')
                ->insert([
                    'OrderID'         => $last,
                    'OrderStatusID'   => 3,
                    'ItemID'          => $value->ItemID,
                    'CreationDate'    => date("Y-m-d H:i:s")
                ]);


            $item = Item::find($value->ItemID);
            $item->IsSold  = true;
            $item->save();

            $item->unsearchable();
        }

        DB::delete('DELETE FROM fashionrecovery."GR_041" WHERE "UserID"='.$user->id);

        return response()->json('success');
    }
}
