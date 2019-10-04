<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Brand extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_017';

    public static function getByDepartment() {

        //return DB::table('fashionrecovery.GR_017')->get(['GR_017.BrandName as name','GR_017.BrandID as id']);

         return DB::table('fashionrecovery.GR_017')
                    ->join('fashionrecovery.GR_025', 'GR_017.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->select('GR_017.BrandName as name','GR_017.BrandID as id','GR_025.DepartmentID')
                    ->where('GR_017.Verified',true)
                    ->where('GR_017.Active',1)
                    ->orderBy('GR_017.BrandName')
                    ->get();
    }

    public static function getBrand($item) {

        return DB::table('fashionrecovery.GR_017')
                ->where('BrandID',$item->BrandID)
                ->first();
    }
}
