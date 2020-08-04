<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Wallet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_051';
    protected $primaryKey = 'WalletID';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'UserID');
    }

}
