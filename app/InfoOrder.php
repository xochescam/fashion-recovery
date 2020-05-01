<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class InfoOrder extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_022';
    protected $primaryKey = 'OrderDetailID';
}
