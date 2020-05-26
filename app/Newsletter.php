<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Newsletter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_043';
    protected $primaryKey = 'NewsletterID';
}
