<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ConfirmAccount;

use DB;
use Redirect;
use Session;
use Auth;
use Mail;

class AuthController extends Controller
{
    protected $table = 'fashionrecovery.GR_001';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user             = Auth::User();
        $seller           = null;
        $sellerSince      = '';
        $creationDateUser = $this->formatDate("d F Y", $user->CreationDate);
        $birthDateUser    = $this->formatDate("d F Y", $user->Birthdate);

        if($user->ProfileID == 2) {
            $seller = DB::table('fashionrecovery.GR_033')
                        ->where('UserID',$id)
                        ->first();

            $sellerSince = $this->formatDate("d F Y", $seller->SellerSince);
        }

        return view('auth.show',compact('seller','creationDateUser','birthDateUser','sellerSince'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = DB::table($this->table)
                    ->where('id',$id)
                    ->first();

        return view('auth.edit',compact('auth'));
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
        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->authData($request->toArray());

            DB::table($this->table)
                ->where('id',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se han actualizado los datos correctamente.');
            return Redirect::to('auth/'.$id);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('auth/'.$id);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        //unique:users,email,'.$id
        $request->validate([
            'name'       => isset($request->name) ? ['max:80'] : [''],
            'last_name'  => isset($request->last_name) ? ['max:80'] : [''],
            'email'      => ['email', 'max:100'],
            'password'   => ['confirmed','min:6'],
            'Alias'      => ['max:30'],
        ]);
    }

    protected function authData($data) {

        return [
             'email'         => $data['email'],
             'Alias'         => $data['Alias'],
             'Name'          => $data['Name'],
             'Lastname'      => $data['last_name'],
             'Notifications' => isset($data['notifications']) ? true : false
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resend($userID) {
        $table = 'fashionrecovery.GR_001';
        $user  = DB::table($table)->where('id',$userID)->first();

        if($user->Confirmed) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            Mail::to($user->email)
                ->send(new ConfirmAccount($user, 0));

            DB::commit();

            Session::flash('success','Se ha reenviado el correo exitosamente.');
            return Redirect::to('dashboard');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to('dashboard');
        }
    }

    public function confirmAccount($userId, $beSeller) {

        $table = 'fashionrecovery.GR_001';
        $user  = DB::table($table)->where('id',$userId)->first();

        if($user->Confirmed) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            DB::table($table)
                ->where('id',$userId)
                ->update(['Confirmed' => true]);

            DB::commit();

            Session::flash('success','Se ha confirmado la cuenta exitosamente');
            return Redirect::to('login/'.$beSeller);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('login/'.$beSeller);
        }
    }
}
