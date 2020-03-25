<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ItemInfo extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_032';
    protected $primaryKey = 'ItemPictureID';

    public function item()
    {
        return $this->belongsTo('App\Item', 'ItemID', 'ItemID');
    }
}
