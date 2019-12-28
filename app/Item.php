<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

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

            $user = Auth::User();
            $id = $item->ItemID;
            $item->ThumbPath = $thumbs[$id]->first()->ThumbPath;

            $item->urlWishlists = !isset($user->id) ? 'login/0' :
                    (!$user->getWishlists() ? 'wishlist/'.$id.'/create' : 
                    ($user->inWishlist($id) ? 
                    'wishlist/'.$user->getWishlists()->WishListID.'/'.$id.'/delete':
                    'wishlist/'.$user->getWishlists()->WishListID.'/'.$id.'/add'));

            return $item;

        });
    }

    public static function getWishlistUrl($item) {

        $user = Auth::User();

        return !isset($user->id) ? 'login/0' :
                (!$user->getWishlists() ? 'wishlist/'.$item.'/create' : 
                ($user->inWishlist($item) ? 
                'wishlist/'.$user->getWishlists()->WishListID.'/'.$item.'/delete':
                'wishlist/'.$user->getWishlists()->WishListID.'/'.$item.'/add'));
    }
}
