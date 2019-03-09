<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = DB::table('fashionrecovery.GR_025')
                        ->get();

        return view('admin.department.list',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
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

        //DB::beginTransaction();

        //try {

            //$data = $this->getData($request->toArray());

            DB::table('fashionrecovery.GR_025')
                ->insert([
                    'DepName'      => 'test',
        +           'Active'       => true,
                    'CreationDate' => '2019-03-08 15:57:47',
                    'CreatedBy'    => 27
                ]);

            Session::flash('success','Se ha guardado correctamente');

            return Redirect::to('/departments/create');

            //DB::commit();

        //} catch (\Exception $ex) {

            //DB::rollback();

            //Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            //return Redirect::to('/departments/create');
        //}
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
        $department = DB::table('fashionrecovery.GR_025')
                        ->where('DepartmentID',$id)
                        ->first();

        return view('admin.department.edit',compact('department'));
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

            DB::table('fashionrecovery.GR_025')
                ->where('DepartmentID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente');

            DB::commit();

            return Redirect::to('/departments/'.$id.'/edit');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/departments/'.$id.'/edit');
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

            $deleted = DB::delete('DELETE FROM fashionrecovery."GR_025" WHERE "DepartmentID"='.$id);

            Session::flash('success','Se ha eliminado correctamente el registro');

            DB::commit();

            return Redirect::to('/departments');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/departments/');
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
            'name'         => ['required']
        ]);
    }


    public function getData($data) {

        return [
            'DepartmentID' => 3,
            'DepName'      => $data['name'],
+           'Active'       => isset($data['active']) ? true : false,
            'CreationDate' => date("Y-m-d H:i:s"),
            'CreatedBy'    => Auth::User()->id
        ];
    }
}
