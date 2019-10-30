<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;

class PaymentController extends Controller
{
    public function payment($ShippingAddID, $IsBuy) {

        $user = Auth::User();

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

            return view('payment.index',compact('address'));

        } else {

            return Redirect::to('address');
        }

    /*     if(!$exists) {

        }

        $address = $IsBuy === "true" ?
                    $this->addToCart($ShippingAddID, $user) :
                    $user->getDefaultAddress();

        
        if(!isset($address->IsDefault)) {

            return Redirect::to('address');

        } else if (!$address && $IsBuy === "true") {
            
            Session::flash('warning','La prenda ya está en el carrito.');
            return Redirect::back();
        } else {

            return view('payment.index',compact('address'));

        } */


        //$address = $this->addToCart($ShippingAddID, $user);

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

        $items   = Auth::User()->getItems();
        $address = Auth::User()->getShippingAddress()
                                ->where('ShippingAddID',$ShippingAddID)
                                ->first();

        return view('payment.confirmation',compact('items','address'));
    }

    public function confirmation($ShippingAddID) {

        $user    = Auth::User();
        $items   = $user->getItems();
        $arrayIt = []; 

        DB::table('fashionrecovery.GR_021')
            ->insert([
                'UserID'          => $user->id,
                'OrderStatusID'   => 1,
                'ShippingID'      => $ShippingAddID,
                'TotalAmount'     => $items->first()->sub, //agregar lo del envío
                'PaymentOptionID' => 2, //agregar lo del pago
                'CreationDate' => date("Y-m-d H:i:s")
            ]);

        $last = DB::table('fashionrecovery.GR_021')
                    ->where('UserID',$user->id)
                    ->orderBy('CreationDate', 'desc')
                    ->first()
                    ->OrderID;

        foreach ($items as $key => $value) {

            $arrayIt += [
                'OrderID'      => $last,
                'ItemID'       => $value->ItemID,
                'CreationDate' => date("Y-m-d H:i:s")
            ];
        }

        DB::table('fashionrecovery.GR_022')
            ->insert($arrayIt);

        DB::table('fashionrecovery.GR_029')
                ->where('ItemID',$items->first()->ItemID)
                ->update(['IsSold' => true]);

        DB::delete('DELETE FROM fashionrecovery."GR_041" WHERE "UserID"='.$user->id);

        return Redirect::to('orders');
    }
}
