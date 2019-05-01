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

    public function getClothingTypebyBrand($DepartmentID,$BrandID,$CategoryID) {

        return DB::table('fashionrecovery.GR_019')
                ->where('DepartmentID',$DepartmentID)
                ->where('BrandID',$BrandID)
                ->where('CategoryID',$CategoryID)
                ->get()
                ->toJson();
    }

    public function getSizesbyClothingType($DepartmentID,$BrandID,$ClothingTypeID) {

        return DB::table('fashionrecovery.GR_020')
                ->where('DepartmentID',$DepartmentID)
        		->where('BrandID',$BrandID)
        		->get()
        		->toJson();
    }
}
