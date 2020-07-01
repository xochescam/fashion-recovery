<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Status extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_013';
    protected $primaryKey = 'OrderStatusID';
    public $timestamps = false;
}
