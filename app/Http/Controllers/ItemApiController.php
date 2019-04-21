<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ItemApiController extends Controller
{
    public function getDepartmentsByBrand($BrandID) {
        $brands = DB::table('fashionrecovery.GR_025')
        					->where('BrandID',$BrandID)
        					->get();
        
    }
}
