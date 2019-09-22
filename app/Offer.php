<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Offer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_031';

    public static function getByAuth() {

        return DB::table('fashionrecovery.GR_031')
            ->where('UserID',Auth::User()->id)
            ->get()
            ->groupBy('OfferID')->toArray();
    }
}



