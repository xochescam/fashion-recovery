<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = DB::table('fashionrecovery.GR_020')
                    ->get();

        // $sizes = DB::table('fashionrecovery.GR_020')
        //             ->join('fashionrecovery.GR_027', 'GR_020.TypeID', '=', 'GR_027.TypeID')
        //             ->join('fashionrecovery.GR_017', 'GR_020.BrandID', '=', 'GR_017.BrandID')
        //             ->join('fashionrecovery.GR_025', 'GR_020.DepartmentID', '=', 'GR_025.DepartmentID')
        //             ->select('GR_020.SizeID','GR_020.SizeName', 'GR_020.Active',  'GR_027.TypeName', 'GR_017.BrandName', 'GR_025.DepName')
        //            ->get();

        return view('admin.size.list',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types       = DB::table('fashionrecovery.GR_027')->get();
        $brands      = DB::table('fashionrecovery.GR_017')->get();
        $departments = DB::table('fashionrecovery.GR_025')->get();

        return view('admin.size.create',compact('types','brands','departments'));
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

            $res = DB::table('fashionrecovery.GR_020')
                ->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('/sizes/create');

        } catch (\Exception $ex) {

             DB::rollback();

             Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
             return Redirect::to('/sizes/create');
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
        $size = DB::table('fashionrecovery.GR_020')
                    ->where('SizeID',$id)
                    ->first();

        $types       = DB::table('fashionrecovery.GR_027')->get();
        $brands      = DB::table('fashionrecovery.GR_017')->get();
        $departments = DB::table('fashionrecovery.GR_025')->get();


        return view('admin.size.edit',compact('size','types','brands','departments'));
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

            DB::table('fashionrecovery.GR_020')
                ->where('SizeID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente');

            DB::commit();

            return Redirect::to('/sizes/'.$id.'/edit');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/sizes/'.$id.'/edit');
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

            $deleted = DB::delete('DELETE FROM fashionrecovery."GR_020" WHERE "SizeID"='.$id);

            Session::flash('success','Se ha eliminado correctamente el registro');

            DB::commit();

            return Redirect::to('/sizes');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/sizes');
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
            'name'       => ['required'],
            //'typeId'       => ['required'],
            //'brandId'      => ['required'],
            //'departmentId' => ['required'],
            'active'     => ['required']
        ]);
    }


    public function getData($data) {

        return [
                'SizeName'          => $data['name'],
                // 'ClothingTypeID' => $data['typeId'],
                // 'BrandID'        => $data['brandId'],
                // 'DepartmentID'   => $data['departmentId'],
                'Active'            => isset($data['active']) ? true : false,
                'CreationDate'      => date("Y-m-d H:i:s"),
                'CreatedBy'         => Auth::User()->id
        ];
    }
}
