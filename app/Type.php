<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_027';

    public static function getAll() {

        return DB::table('fashionrecovery.GR_027')
                ->where('Active',1)
                ->orderBy('TypeName')
                ->get();
    }
}
