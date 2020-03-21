<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Category extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_026';
    protected $primaryKey = 'CategoryID';

    public function item()
    {
        return $this->hasOne('App\Item', 'ItemID');
    }

    public static function getByDepartment() {

        return DB::table('fashionrecovery.GR_026')
                ->join('fashionrecovery.GR_025', 'GR_026.DepartmentID', '=', 'GR_025.DepartmentID')
                ->select('GR_026.CategoryID','GR_026.CategoryName','GR_025.DepartmentID')
                ->where('GR_026.Active',1)
                ->orderBy('GR_026.CategoryName')
                ->get()
                ->groupBy('DepartmentID');
    }
}
