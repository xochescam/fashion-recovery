<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;
use Gate;

use App\User;
use App\Seller;
use App\Wallet;

class UserController extends Controller
{
    protected $table = 'fashionrecovery.GR_001';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('show-users')) {
            abort(403);
        }

        $users   = User::all();
        $sellers = Seller::all();

        $users = $users->map(function ($item, $key) use($sellers) {
            //$seller = $sellers->where('UserID',$item->id)->first();
            //$item->CreationDate  = $this->formatDate("d F Y", $item->CreationDate);

            $wallet = Wallet::where('UserID',$item->id)->first();
            $bank = [];

            if(isset($wallet->IsTransfer)) {

                $bank = DB::table('fashionrecovery.GR_053')
                         ->where('UserID',$item->id)->first();
            }

            return [
                'id' => $item->id,
                'alias' => $item->Alias,
                'buys' => User::getBuyItems($item),
                'sells' => User::getSoldItems($item),
                'cartera' => isset($wallet->Amount) ? $wallet->Amount : '$0.00',
                'IsTransfer' => isset($wallet->IsTransfer) ? $wallet->IsTransfer : Null,
                'bank' => $bank

            ]; 
/* 
            if(isset($seller->UserID)) {

                $item->IsTransfer =  $seller->IsTransfer;
                $item->Sum        =  User::getSum($item);
                $item->Sold       =  User::getSoldItems($item);

            } else {

                $wallet = Wallet::where('UserID',$item->id)->first();

                $item->Wallet     = isset($wallet->Amount) ? $wallet->Amount : '$0.00';
                $item->IsTransfer = isset($wallet->IsTransfer) ? $wallet->IsTransfer : Null;
                $item->Buy = User::getBuyItems($item);
            }
 */
            return $item;

        });

        return view('users.list',compact('users','sellers'));
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

    public function block($user)
    {
        if (Gate::denies('block-users')) {
            abort(403);
        }

        $user = User::where('Alias',$user)->first();
        $user->IsBlocked = true;
        $user->save();

        Session::flash('success','Se ha bloqueado el usuario '.$user->Alias);
        return Redirect::back();
    }

    public function unblock($user)
    {
        if (Gate::denies('block-users')) {
            abort(403);
        }

        $user = User::where('Alias',$user)->first();
        $user->IsBlocked = false;
        $user->save();

        Session::flash('success','Se ha desbloqueado el usuario '.$user->Alias);
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
    }


}
