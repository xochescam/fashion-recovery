<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ItemApiController extends Controller
{
    public function getBrandsbyDepartment($DepartmentID) {

        return DB::table('fashionrecovery.GR_017')
        					->where('DepartmentID',$DepartmentID)
                            ->where('Active',1)       
                            ->orderBy('BrandName','desc')
        					->get()
        					->toJson();
    }

    public function getClothingTypeOnlybyBrand($DepartmentID,$BrandID) {

        return DB::table('fashionrecovery.GR_019')
                ->where('Active',1)       
                ->where('DepartmentID',$DepartmentID)
                ->where('BrandID',$BrandID)
                ->orderBy('ClothingTypeName')
                ->get()
                ->toJson();
    }

    public function getClothingTypebyBrand($DepartmentID,$BrandID,$CategoryID) {

        return DB::table('fashionrecovery.GR_019')
                ->where('Active',1)       
                ->where('DepartmentID',$DepartmentID)
                ->where('BrandID',$BrandID)
                ->where('CategoryID',$CategoryID)
                ->orderBy('ClothingTypeName')
                ->get()
                ->toJson();
    }

    public function getSizesbyClothingType($DepartmentID,$BrandID,$ClothingTypeID) {

        return DB::table('fashionrecovery.GR_020')
                ->where('Active',1)       
                ->where('DepartmentID',$DepartmentID)
        		->where('BrandID',$BrandID)
                ->where('ClothingTypeID',$ClothingTypeID)
                ->orderBy('SizeName')
        		->get()
        		->toJson();
    }
}
