<?php

namespace App\Http\Controllers\Catalogs;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

class OthersBrandsController extends Controller
{
	protected $table = 'fashionrecovery.GR_036';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	$otherBrands = DB::table($this->table)
                        ->orderBy('OtherBrand')
                        ->get();

        return view('catalogs.other-brands',compact('otherBrands'));
    }
}
