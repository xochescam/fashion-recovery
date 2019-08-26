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

    public function confirmation($ShippingAddID) {

        $items = Auth::User()->getItems();
        $address = Auth::User()->getShippingAddress()
                                ->where('ShippingAddID',$ShippingAddID)
                                ->first();

        return view('payment.confirmation',compact('items','address'));
    }
}
