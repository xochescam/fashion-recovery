<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;
use Gate;

class BillingInfoController extends Controller
{
    protected $table = 'fashionrecovery.GR_003';

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
        if (Gate::denies('billing-info')) {
            abort(403);
        }

        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->data($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se han guardado correctamente los datos de facturación.');
            return Redirect::to('auth/'.Auth::User()->id); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to('auth/'.Auth::User()->id);
        }
    }

    protected function data($data) {

        return [
             'UserID'          => Auth::User()->id,
             'Alias'           => $data['Alias'],
             'RFC'             => $data['RFC'],
             'Street'          => $data['Street'],
             'Suburb'          => $data['Suburb'],
             'ZipCode'         => $data['ZipCode'],
             'City'            => $data['City'],
             'State'           => $data['State'],
             'Mail'            => $data['Mail'],
             'CreationDate'    => date("Y-m-d H:i:s"),
             'Active'          => true, //
             'IsDefault'       => true, //

        ];
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        $request->validate([
             'Alias'           => ['max:30'],
             'RFC'             => ['max:13'],
             'Street'          => ['max:50'],
             'Suburb'          => ['max:50'],
             'ZipCode'         => ['numeric'],
             'City'            => ['max:25'],
             'State'           => ['max:25'],
             'Mail'            => ['email'],
        ]);
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
        //
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
        $user = User::findOrfail($id);

        if(!$this->authorize('updateUser',  $user)) {
            abort(403);
        }
        
        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->data($request->toArray());

            DB::table($this->table)
                ->where('BillingInfoID',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se han modificado correctamente los datos de facturación.');
            return Redirect::to('auth/'.Auth::User()->id); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to('auth/'.Auth::User()->id);
        }
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
