<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;

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
        $user = Auth::User();
        $seller = DB::table('fashionrecovery.GR_033')
                    ->where('UserID',$id)
                    ->first();

        $creationDateUser = $this->formatDate("d F Y", $user->CreationDate);
        $birthDateUser    = $this->formatDate("d F Y", $user->Birthdate);
        $sellerSince      = $this->formatDate("d F Y", $seller->SellerSince);

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

        //DB::beginTransaction();

        //try {

            $data = $this->authData($request->toArray());

            DB::table($this->table)
                ->where('id',$id)
                ->update($data);

            //DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('seller/'.$id);

        //} catch (\Exception $ex) {

            //DB::rollback();

            //Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            //return Redirect::to('auth/'.$id.'/edit');
        //}
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
            'name'      => ['required', 'max:80'],
            'last_name' => ['required', 'max:80'],
            'email'     => ['required', 'email', 'max:100'],
            'alias'     => ['required','max:30']
        ]);
    }

    protected function authData($data) {

        return [
             'email'         => $data['email'],
             'Alias'         => $data['alias'],
             'Name'          => $data['name'],
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
}
