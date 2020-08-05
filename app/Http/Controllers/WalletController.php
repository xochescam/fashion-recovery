<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Gate;

use App\Wallet;
use App\Order;
use App\InfoOrder;
use App\Transfer;

use Session;
use Storage;
use Redirect;
use Image;

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

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $wallet = Wallet::where('UserID',Auth::User()->id)->first();

        $wallet->IsTransfer = false;
        $wallet->save();

        Session::flash('success','Hemos recibido tu petición. En breve nos podremos en contacto contigo.');
        return Redirect::back();
    }

    public function transferConfirm(Request $request, $id) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        foreach ($request->Photos as $key => $value) {

            $data = $this->saveFile($value, $key, $id);

            $transfer = new Transfer;
            $transfer->UserID = $id;
            $transfer->CreatedDate = date("Y-m-d H:i:s");
            $transfer->FileUrl = $data[0]['name'];
            $transfer->save();
        }

        $wallet = Wallet::where('UserID',$id)->first();

        $wallet->IsTransfer = true;
        $wallet->Amount = 0;
        $wallet->save();
        
        Session::flash('success','Se ha confirmado la transacción.');
        return Redirect::back();
    }

    public function saveFile($value, $key, $UserID) {

        $date   = date("Ymd-His");
        $dir = 'transfer/';
        $names = [];

        if($value->getMimeType() === "application/pdf") {

            $name = $UserID.'-'.$date.'-'.$key.'.pdf';
            $real = $value;

        } else {

            $name = $UserID.'-'.$date.'-'.$key.'.png';

            $real = Image::make($value->getRealPath())
                        ->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
            })->orientate();

            $real->stream();
        }

        \Storage::disk('public')->put($dir.$name, $real, 'public');

        $items = [
            'name' => $dir.$name,
        ];

        array_push($names,$items);

        return $names;
    }

}
