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
