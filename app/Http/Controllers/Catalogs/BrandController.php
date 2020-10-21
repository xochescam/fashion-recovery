<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;
use Gate;

class BrandController extends Controller
{
    protected $table = 'fashionrecovery.GR_017';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('show-category')) {
            abort(403);
        }

        $brands = DB::table($this->table)
                    //->join('fashionrecovery.GR_025', 'GR_017.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->select('GR_017.BrandID',
                             'GR_017.BrandName',
                             'GR_017.Verified', 
                             'GR_017.Active', 
                             'GR_017.DepartmentID')
                    ->orderBy('BrandName')
                    ->get();

    
        $departments = DB::table('fashionrecovery.GR_025')
                        ->select('DepartmentID',
                                 'DepName')->get()
                        ->groupBy('DepartmentID')->toArray();      
                        
        return view('catalogs.brand.list',compact('brands','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-category')) {
            abort(403);
        }

        $departments = DB::table('fashionrecovery.GR_025') 
                        ->where('Active',1)       
                        ->orderBy('DepName')
                        ->get();

        return view('catalogs.brand.create', compact('departments'));
    }

    public function verify($id)
    {
        if (Gate::denies('accept-brand')) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            DB::table($this->table)
                ->where('BrandID',$id)
                ->update([
                    'Verified' => true
                ]);

            DB::commit();

            Session::flash('success','Se ha verificado correctamente la marca.');
            return Redirect::to('brands');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('brands');
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-category')) {
            abort(403);
        }

        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('brands');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('brands/create');
        }

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
        if (Gate::denies('update-category')) {
            abort(403);
        }

        $brand = DB::table($this->table)
                    ->where('BrandID',$id)
                    ->first();

        $departments = DB::table('fashionrecovery.GR_025')
                        ->where('Active',1)
                        ->get();

        return view('catalogs.brand.edit',compact('brand','departments'));
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
        if (Gate::denies('update-category')) {
            abort(403);
        }

        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('BrandID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente');

            DB::commit();

            return Redirect::to('brands');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('brands/'.$id.'/edit');
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
        if (Gate::denies('delete-category')) {
            abort(403);
        }

         DB::beginTransaction();

        try {

            $explode     = explode('.', $this->table);
            $stringTable = $explode[0].'."'.$explode[1].'"';

            DB::delete('DELETE FROM '.$stringTable.' WHERE "BrandID"='.$id);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el registro');
            return Redirect::to('brands');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('brands');
        }
    }


    /**
     * Validate the brand request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validator($request)
    {
        return $request->validate([
            'name'         => ['required'],
        ]);
    }

    public function getData($data) {

        return [
             'BrandName'    => $data['name'],
             'Active'       => isset($data['active']) ? true : false,
             'DepartmentID' => $data['DepartmentID'],
             'CreationDate' => date("Y-m-d H:i:s"),
             'CreatedBy'    => Auth::User()->id,
             'Verified'     => true
        ];
    }
}