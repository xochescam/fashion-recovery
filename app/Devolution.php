<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Devolution extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_046';
    protected $primaryKey = 'ReturnID';
    public $timestamps = false;
}
