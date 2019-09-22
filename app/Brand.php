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

    public static function getAll() {

        return DB::table('fashionrecovery.GR_017')
                ->where('Verified',true)
                ->orderBy('GR_017.BrandName')
                ->get();
    }

    public static function getBrand($item) {

        return DB::table('fashionrecovery.GR_017')
                ->where('BrandID',$item->BrandID)
                ->first();
    }
}
