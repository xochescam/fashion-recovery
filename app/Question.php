<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Question extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_044';
    protected $primaryKey = 'QuestionID';
}
