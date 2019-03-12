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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
