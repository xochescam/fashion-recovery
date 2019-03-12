<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

class ClothingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clothingTypes = DB::table('fashionrecovery.GR_019')->get();

        // $sizes = DB::table('fashionrecovery.GR_019')
        //             ->join('fashionrecovery.GR_017', 'GR_019.BrandID', '=', 'GR_017.BrandID')
        //             ->join('fashionrecovery.GR_025', 'GR_019.DepartmentID', '=', 'GR_025.DepartmentID')
        //             ->select('GR_019.ClothingTypeID','GR_019.ClothingTypeName', 'GR_019.Active',  'GR_027.BrandName', 'GR_017.DepartmentName', 'GR_025.DepName')
        //            ->get();

        return view('admin.clothing-type.list',compact('clothingTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands      = DB::table('fashionrecovery.GR_017')->get();
        $departments = DB::table('fashionrecovery.GR_025')->get();

        return view('admin.clothing-type.create',compact('brands','departments'));
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

            DB::table('fashionrecovery.GR_019')
                ->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('/clothing-types/create');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('/clothing-types/create');
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
        $clothingType = DB::table('fashionrecovery.GR_019')
                            ->where('ClothingTypeID',$id)
                            ->first();

        $brands      = DB::table('fashionrecovery.GR_017')->get();
        $departments = DB::table('fashionrecovery.GR_025')->get();

        return view('admin.clothing-type.edit',compact('clothingType','brands','departments'));
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

            DB::table('fashionrecovery.GR_019')
                ->where('ClothingTypeID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente');

            DB::commit();

            return Redirect::to('/clothing-type/'.$id.'/edit');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/clothing-type/'.$id.'/edit');
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
            'departmentId' => ['required']
        ]);
    }


    public function getData($data) {

        return [
             'ClothingTypeName' => $data['name'],
             'BrandID'          => $data['brandId'],
             'DepartmentID'     => $data['departmentId'],
             'Active'           => isset($data['active']) ? true : false,
             'CreationDate'     => date("Y-m-d H:i:s"),
             'CreatedBy'        => Auth::User()->id
        ];
    }
}
