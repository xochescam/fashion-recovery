<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Order extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_021';
    protected $primaryKey = 'OrderID';

    public function info()
    {
        return $this->hasMany('App\InfoOrder', 'OrderID');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'UserID');
    }
}
