<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class ReturnComments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_049';
    protected $primaryKey = 'CommentID';
    public $timestamps = false;
}
