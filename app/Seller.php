<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Seller extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_033';
    protected $primaryKey = 'SellerID';

    public function user()
    {
        return $this->belongsTo('App\User', 'UserID');
    }
}
