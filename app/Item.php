<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_029';

    public static function getThumbs($all) {

        return DB::table('fashionrecovery.GR_032')
                ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                ->where('IsCover',true)
                ->get()
                ->groupBy('ItemID');
    }

    public static function getItemThumbs($items, $thumbs) {

        return $items->map(function ($item, $key) use($thumbs) {

            $item->ThumbPath = $thumbs[$item->ItemID]->first()->ThumbPath;

            return $item;

        });
    }
}
