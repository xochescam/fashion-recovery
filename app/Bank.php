<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Bank extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_054';
    protected $primaryKey = 'BankID';
    public $timestamps = false;
}
