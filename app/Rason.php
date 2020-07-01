<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Rason extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_047';
    protected $primaryKey = 'RasonID';
    public $timestamps = false;
}
