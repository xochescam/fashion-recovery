<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ItemApiController extends Controller
{
    public function getBrandsbyDepartment($DepartmentID) {

        return DB::table('fashionrecovery.GR_017')
        					->where('DepartmentID',$DepartmentID)
        					->get()
        					->toJson();
    }

    public function getSizesbyBrand($DepartmentID,$BrandID) {

        return DB::table('fashionrecovery.GR_020')
                ->where('DepartmentID',$DepartmentID)
        		->where('BrandID',$BrandID)
        		->get()
        		->toJson();
    }
}
