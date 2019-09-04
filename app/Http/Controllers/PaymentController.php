<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;

class PaymentController extends Controller
{
    public function payment($ShippingAddID) {

    	$address = Auth::User()->getShippingAddress()
                                ->where('ShippingAddID',$ShippingAddID)
                                ->first();

    	return view('payment.index',compact('address'));
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
