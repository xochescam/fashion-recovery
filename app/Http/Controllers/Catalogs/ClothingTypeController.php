<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

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
        $clothingTypes = DB::table($this->table)
                            ->join('fashionrecovery.GR_017', 'GR_019.BrandID', '=', 'GR_017.BrandID')
                            ->join('fashionrecovery.GR_025', 'GR_019.DepartmentID', '=', 'GR_025.DepartmentID')
                            ->join('fashionrecovery.GR_026', 'GR_019.CategoryID', '=', 'GR_026.CategoryID')
                            ->select('GR_019.ClothingTypeID','GR_019.ClothingTypeName', 'GR_019.Active',  'GR_017.BrandName', 'GR_025.DepName', 'GR_026.CategoryName')
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
        $brands      = DB::table('fashionrecovery.GR_017')
                        ->orderBy('BrandName')
                        ->get();

        $departments = DB::table('fashionrecovery.GR_025') 
                        ->where('Active',1)       
                        ->orderBy('DepName')
                        ->get();

        $categories  = DB::table('fashionrecovery.GR_026')
                        ->where('Active',1)       
                        ->orderBy('CategoryName')
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
        $exist = DB::table($this->table)
                ->where('ClothingTypeName',$request->name)
                ->where('BrandID',$request->brandId)
                ->where('DepartmentID',$request->departmentId)
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
        $clothingType = DB::table($this->table)
                            ->where('ClothingTypeID',$id)
                            ->first();

        $departments = DB::table('fashionrecovery.GR_025')
                        ->where('Active',1)->get();
        $categories  = DB::table('fashionrecovery.GR_026')
                        ->where('Active',1)->get();
        $brands      = DB::table('fashionrecovery.GR_017')
                        ->where('Active',1)       
                        ->where('DepartmentID',$clothingType->DepartmentID)
                        ->get();

        return view('catalogs.clothing-type.edit',compact('clothingType','brands','departments','categories'));
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
            'brandId'      => ['required'],
            'departmentId' => ['required'],
            'categoryId'   => ['required']
        ]);
    }


    public function getData($data) {

        return [
             'ClothingTypeName' => $data['name'],
             'BrandID'          => $data['brandId'],
             'DepartmentID'     => $data['departmentId'],
             'CategoryID'       => $data['categoryId'],
             'Active'           => isset($data['active']) ? true : false,
             'CreationDate'     => date("Y-m-d H:i:s"),
             'CreatedBy'        => Auth::User()->id
        ];
    }
}
