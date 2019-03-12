<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = DB::table('fashionrecovery.GR_018')
                    ->get();

        return view('admin.color.list',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
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

            $res = DB::table('fashionrecovery.GR_018')
                    ->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('/colors/create');

        } catch (\Exception $ex) {

             DB::rollback();

             Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
             return Redirect::to('/colors/create');
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
        $color = DB::table('fashionrecovery.GR_018')
                    ->where('ColorID',$id)
                    ->first();

        return view('admin.color.edit',compact('color'));
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

            DB::table('fashionrecovery.GR_018')
                ->where('ColorID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente');

            DB::commit();

            return Redirect::to('/colors/'.$id.'/edit');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/colors/'.$id.'/edit');
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

            $deleted = DB::delete('DELETE FROM fashionrecovery."GR_018" WHERE "ColorID"='.$id);

            Session::flash('success','Se ha eliminado correctamente el registro');

            DB::commit();

            return Redirect::to('/colors');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('/colors/');
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
            'name'         => ['required']
        ]);
    }


    public function getData($data) {

        return [
             'ColorName'    => $data['name'],
             'Active'       => isset($data['active']) ? true : false,
             'CreationDate' => date("Y-m-d H:i:s"),
             'CreatedBy'    => Auth::User()->id
        ];
    }
}
