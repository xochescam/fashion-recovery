<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Closet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_030';
    protected $primaryKey = 'ClosetID';
    public $timestamps = false;


    public static function getByAuth() {

        return DB::table('fashionrecovery.GR_030')
                ->where('UserID',Auth::User()->id)
                ->orderBy('ClosetName')
                ->get();
    }
}
