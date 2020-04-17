<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;
use Gate;

class ClothingTypeController extends Controller
{
    protected $table = 'fashionrecovery.GR_019';

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

        $clothingTypes = DB::table($this->table)
                            ->join('fashionrecovery.GR_026', 'GR_019.CategoryID', '=', 'GR_026.CategoryID')
                            ->join('fashionrecovery.GR_025', 'GR_026.DepartmentID', '=', 'GR_025.DepartmentID')
                            ->select('GR_025.DepName', 'GR_019.ClothingTypeID','GR_019.ClothingTypeName', 'GR_019.Active', 'GR_026.CategoryName')
                            ->orderBy('ClothingTypeName')
                            ->get();

        return view('catalogs.clothing-type.list',compact('clothingTypes'));
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

        $categories  = DB::table('fashionrecovery.GR_026')
                        ->join('fashionrecovery.GR_025', 'GR_026.DepartmentID', '=', 'GR_025.DepartmentID')
                        ->where('GR_026.Active',1) 
                        ->select('GR_026.CategoryID','GR_026.CategoryName','GR_025.DepName','GR_026.Active')      
                        ->orderBy('GR_026.CategoryName')
                        ->get();

        return view('catalogs.clothing-type.create',compact('brands','departments','categories'));
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

        $exist = DB::table($this->table)
                ->where('ClothingTypeName',$request->name)
                ->where('CategoryID',$request->categoryId)
                ->first();

        if(isset($exist)) {
            Session::flash('warning','El tipo de prenda ya existe. Ingresa otro diferente.');
            return Redirect::to('clothing-types/create');
        }

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('clothing-types');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('clothing-types/create');
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

        $clothingType = DB::table($this->table)
                            ->where('ClothingTypeID',$id)
                            ->first();

        $categories  = DB::table('fashionrecovery.GR_026')
                            ->join('fashionrecovery.GR_025', 'GR_026.DepartmentID', '=', 'GR_025.DepartmentID')
                            ->where('GR_026.Active',1) 
                            ->select('GR_026.CategoryID','GR_026.CategoryName','GR_025.DepName','GR_026.Active')      
                            ->orderBy('GR_026.CategoryName')
                            ->get();

        return view('catalogs.clothing-type.edit',compact('clothingType','categories'));
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

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('ClothingTypeID',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('clothing-types');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('clothing-types/'.$id.'/edit');
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

            DB::delete('DELETE FROM '.$stringTable.' WHERE "ClothingTypeID"='.$id);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el registro');
            return Redirect::to('clothing-types');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('clothing-types');
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
            'categoryId'   => ['required']
        ]);
    }


    public function getData($data) {

        return [
             'ClothingTypeName' => $data['name'],
             'CategoryID'       => $data['categoryId'],
             'Active'           => isset($data['active']) ? true : false,
             'CreationDate'     => date("Y-m-d H:i:s"),
             'CreatedBy'        => Auth::User()->id
        ];
    }
}
