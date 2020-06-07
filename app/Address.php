<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_002';
    protected $primaryKey = 'ShippingAddID';
    public $timestamps = false;

}