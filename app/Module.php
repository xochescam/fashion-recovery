<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Module extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_009';
    protected $primaryKey = 'ModulesID';
}
