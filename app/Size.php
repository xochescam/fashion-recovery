<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Size extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_020';

    public static function getByCategory() {

        return DB::table('fashionrecovery.GR_020')
            ->join('fashionrecovery.GR_026', 'GR_020.CategoryID', '=', 'GR_026.CategoryID')
            ->join('fashionrecovery.GR_025', 'GR_026.DepartmentID', '=', 'GR_025.DepartmentID')
            ->select('GR_025.DepName','GR_020.SizeID','GR_020.SizeName', 'GR_020.Active', 'GR_026.CategoryName','GR_026.CategoryID')
            ->get()
            ->groupBy('CategoryID');
    }
}
