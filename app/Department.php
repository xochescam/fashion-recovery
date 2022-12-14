<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Department extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_025';
    protected $primaryKey = 'DepartmentID';

    public function item()
    {
        return $this->hasOne('App\Item', 'ItemID');
    }

    public static function getAll() {

        return DB::table('fashionrecovery.GR_025')
                ->where('Active',1)
                ->orderBy('DepName')
                ->get(['DepartmentID as value', 'DepName as option']);
    }
}
