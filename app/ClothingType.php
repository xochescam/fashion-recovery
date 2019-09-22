<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ClothingType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_019';

    public static function getByCategory() {

        return DB::table('fashionrecovery.GR_019')
                ->join('fashionrecovery.GR_026', 'GR_019.CategoryID', '=', 'GR_026.CategoryID')
                ->join('fashionrecovery.GR_025', 'GR_026.DepartmentID', '=', 'GR_025.DepartmentID')
                ->select('GR_025.DepName', 'GR_019.ClothingTypeID','GR_019.ClothingTypeName', 'GR_019.Active', 'GR_026.CategoryName','GR_026.CategoryID')
                ->get()
                ->groupBy('CategoryID');
    }
}
