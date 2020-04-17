<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;
use Gate;

class ColorController extends Controller
{
    protected $table = 'fashionrecovery.GR_018';

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

        $colors = DB::table($this->table)
                    ->orderBy('ColorName')
                    ->get();

        return view('catalogs.color.list',compact('colors'));
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
        
        return view('catalogs.color.create');
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

            $res = DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('colors');

        } catch (\Exception $ex) {

             DB::rollback();

             Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
             return Redirect::to('colors/create');
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

        $color = DB::table($this->table)
                    ->where('ColorID',$id)
                    ->first();

        return view('catalogs.color.edit',compact('color'));
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
        if (Gate::denies('delete-category')) {
            abort(403);
        }
        
        if (Gate::denies('update-category')) {
            abort(403);
        }

        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('ColorID',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('colors');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('colors/'.$id.'/edit');
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

            $deleted = DB::delete('DELETE FROM '.$stringTable.' WHERE "ColorID"='.$id);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el registro');
            return Redirect::to('colors');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('colors');
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
            'name' => ['required']
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
