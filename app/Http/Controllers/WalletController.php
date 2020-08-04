<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Gate;

use App\Wallet;
use App\Order;
use App\InfoOrder;

use Session;
use Redirect;

class WalletController extends Controller
{
    public function index() {

/*         if (Gate::denies('show-notifications')) {
            abort(403);
        }

    	$user = Auth::User(); */

        $wallet = Wallet::where('UserID',Auth::User()->id)->first(); 
        //Agregar update para poder retirar el dinero
        
        return view('wallet.index',compact('wallet'));
    }

    public function transferWallet() {

        $wallet = Wallet::where('UserID',Auth::User()->id)->first();

        $wallet->IsTransfer = false;
        $wallet->save();

        Session::flash('success','Hemos recibido tu petición. En breve nos podremos en contacto contigo.');
        return Redirect::back();
    }

    public function transferConfirm($id) {
        $wallet = Wallet::where('UserID',$id)->first();

        $wallet->IsTransfer = true;
        $wallet->Amount = 0;
        $wallet->save();
        
        Session::flash('success','Se ha confirmado la transacción.');
        return Redirect::back();
    }
}
