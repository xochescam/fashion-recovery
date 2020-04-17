<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Access extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_008';
    protected $primaryKey = 'AccessRightID';
}
