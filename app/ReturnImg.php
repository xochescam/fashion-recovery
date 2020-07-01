<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class ReturnImg extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_048';
    protected $primaryKey = 'ReturnID';
    public $timestamps = false;
}
