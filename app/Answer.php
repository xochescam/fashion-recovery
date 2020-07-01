<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Answer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_045';
    protected $primaryKey = 'StatisticsID';
    public $timestamps = false;
}
