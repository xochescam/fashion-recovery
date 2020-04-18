<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;

use App\States;

class ShippingAddressController extends Controller
{
    protected $table = 'fashionrecovery.GR_002';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Auth::User()->getShippingAddress();
        $states    = States::get();
        $isNew     = count($addresses) > 0 ? false : true;
        $url       = $isNew ? 'address.create' : 'address.index';
        $type_url  = 'address';
        $data      = $isNew ? compact('isNew','type_url','states') : compact('addresses','isNew','type_url','states');

        return view($url,$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type_url)
    {
        if(!Auth::User()->isBuyerProfile()) {
            return abort(403);
        }

        $isNew = true;
        $title    = $type_url == 'address' ? 'Selecciona una dirección de envío' : 'Dirección de envío';
        $states = States::get();

        return view('address.create',compact('isNew','type_url','title','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::User()->isBuyerProfile()) {
            return abort(403);
        }
        
        $this->validator($request);

        $urltype = [
            'address'      => 'address',
            'auth'         => 'auth/'.Auth::User()->id,
        ];

        $url = $urltype[$request->type_url];

        DB::beginTransaction();

        try {

            $data = $this->data($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente la dirección de envio.');
            return Redirect::to($url); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to($url); //cambiar

        }
    }

    protected function data($data) {

        return [
             'UserID'          => Auth::User()->id,
             'Alias'           => $data['Alias'],
             'Street'          => $data['Street'],
             'Suburb'          => $data['Suburb'],
             'ZipCode'         => $data['ZipCode'],
             'State'           => $data['State'],
             'City'            => $data['City'],
             'Ext'             => $data['Ext'],
             'Int'             => $data['Int'],
             'PhoneContact'    => $data['PhoneContact'],
             'References'      => $data['References'],
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
            'Alias'                => ['max:50'],
            'Street'               => ['max:50'],
            'Suburb'               => ['max:50'],
            'ZipCode'              => ['regex:/^\d{5}$|^\d{5}-\d{4}$/'],
            'Ext'                  => ['max:50'],
            'Int'                  => ['max:50'],
            'State'                => ['max:50'],
            'City'                 => ['max:25'],
            'PhoneContact'         => ['numeric','digits:10'],
            'References'           => ['max:100']
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
    public function edit($id, $type_url)
    {
        $title    = $type_url == 'address' ? 'Selecciona una dirección de envío' : 'Dirección de envío';
        $isNew    = false;
        $states   = States::get();
        $address  = DB::table('fashionrecovery.GR_002')
                        ->where('ShippingAddID',$id)
                        ->get()->first();

        return view('address.edit',compact('address','isNew','type_url','title','states'));
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

        $urltype = [
            'address'      => 'address',
            'auth'         => 'auth/'.Auth::User()->id,
            'confirmation' => 'confirmation/'.$id
        ];

        $url = $urltype[$request->type_url];

        DB::beginTransaction();

        try {

            $data = $this->data($request->toArray());

            DB::table($this->table)
                ->where('ShippingAddID',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se han modificado correctamente los datos de dirección de envío.');
            return Redirect::to($url); //cambiar


        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to($url); //cambiar
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
        $user = User::findOrfail($id);

        if(!$this->authorize('deleteUser',  $user)) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            $explode     = explode('.', $this->table);
            $stringTable = $explode[0].'."'.$explode[1].'"';

            DB::delete('DELETE FROM '.$stringTable.' WHERE "ShippingAddID"='.$id);

            DB::delete('DELETE FROM fashionrecovery."GR_002" WHERE "ShippingAddID"='.$id);


            DB::commit();

            Session::flash('success','Se ha eliminado correctamente la dirección.');
            return Redirect::back();

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::back();
        }
    }
}
