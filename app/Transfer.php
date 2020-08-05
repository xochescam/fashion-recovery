<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Transfer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_052';
    protected $primaryKey = 'TransferID';
    public $timestamps = false;
}
