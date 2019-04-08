<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

class SizeController extends Controller
{
    protected $table = 'fashionrecovery.GR_020';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = DB::table($this->table)
                    ->join('fashionrecovery.GR_019', 'GR_020.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->join('fashionrecovery.GR_017', 'GR_020.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_025', 'GR_020.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->select('GR_020.SizeID','GR_020.SizeName', 'GR_020.Active',  'GR_019.ClothingTypeName', 'GR_017.BrandName', 'GR_025.DepName')
                    ->get();

        return view('catalogs.size.list',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clothingTypes = DB::table('fashionrecovery.GR_019')->get();
        $brands        = DB::table('fashionrecovery.GR_017')->get();
        $departments   = DB::table('fashionrecovery.GR_025')->get();

        return view('catalogs.size.create',compact('clothingTypes','brands','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            $res = DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('sizes');

        } catch (\Exception $ex) {

             DB::rollback();

             Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
             return Redirect::to('sizes/create');
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
        $size = DB::table($this->table)
                    ->where('SizeID',$id)
                    ->first();

        $clothingTypes = DB::table('fashionrecovery.GR_019')->get();
        $brands        = DB::table('fashionrecovery.GR_017')->get();
        $departments   = DB::table('fashionrecovery.GR_025')->get();



        return view('catalogs.size.edit',compact('size','clothingTypes','brands','departments'));
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

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('SizeID',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('sizes');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('sizes/'.$id.'/edit');
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

            DB::delete('DELETE FROM '.$stringTable.' WHERE "SizeID"='.$id);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el registro');
            return Redirect::to('sizes');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('sizes');
        }
    }

    /**
     * Validate the department request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validator($request)
    {
        return $request->validate([
            'name'           => ['required'],
            'clothingTypeId' => ['required'],
            'brandId'        => ['required'],
            'departmentId'   => ['required'],
            'active'         => ['required']
        ]);
    }


    public function getData($data) {

        return [
                'SizeName'       => $data['name'],
                'ClothingTypeID' => $data['clothingTypeId'],
                'BrandID'        => $data['brandId'],
                'DepartmentID'   => $data['departmentId'],
                'Active'         => isset($data['active']) ? true : false,
                'CreationDate'   => date("Y-m-d H:i:s"),
                'CreatedBy'      => Auth::User()->id
        ];
    }
}