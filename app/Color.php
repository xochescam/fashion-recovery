<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Color extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_018';

    public static function getAll() {

        return DB::table('fashionrecovery.GR_018')
                ->where('Active',1)
                ->orderBy('ColorName')->get();
    }
}
