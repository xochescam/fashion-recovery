<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class Item extends Model
{
    use Searchable;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fashionrecovery.GR_029';
    protected $primaryKey = 'ItemID';

    public function user()
    {
        //return $this->belongsTo('App\User', 'OwnerID');
        return $this->hasMany('App\User', 'id', 'OwnerID');
    }
    
    public function owner()
    {
        return $this->belongsTo('App\User', 'OwnerID');
    }

    public function order()
    {
        return $this->belongsTo('App\InfoOrder', 'ItemID');
        //return $this->hasMany('App\InfoOrder', 'ItemID');
    }

    public function info()
    {
        return $this->hasMany('App\ItemInfo', 'ItemID');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'DepartmentID');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'CategoryID');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'BrandID');
    }

    public function clothingType()
    {
        return $this->belongsTo('App\ClothingType', 'ClothingTypeID');
    }

    public function size()
    {
        return $this->belongsTo('App\Size', 'SizeID');
    }

    public function color()
    {
        return $this->belongsTo('App\Color', 'ColorID');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'fashionrecovery.GR_029';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {

        $array = $this->toArray();

        $array = $this->transform($array);

        $array['DepName']          = $this->department->DepName;
        $array['CategoryName']     = $this->category->CategoryName;
        $array['BrandName']        = $this->brand->BrandName;
        $array['ClothingTypeName'] = $this->clothingType->ClothingTypeName;
        $array['SizeName']         = $this->size->SizeName;
        $array['ColorName']        = $this->color->ColorName;
        $array['ThumbPath']        = $this->info->where('IsCover',true)->first()->ThumbPath;

        return $array;
    }

    public static function getMyItems() {

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_026', 'GR_029.CategoryID', '=', 'GR_026.CategoryID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->select('GR_001.Alias',
                            'GR_029.ItemDescription',
                             'GR_025.DepName',
                             'GR_026.CategoryName',
                             'GR_017.BrandName',
                             'GR_019.ClothingTypeName',
                             'GR_020.SizeName',
                             'GR_018.ColorName'
                             )
                    ->get();
            
            return $items->map(function ($item, $key) {

                return collect($item)->toArray();
            });

  /*       return $items->map(function ($item, $key) {

            $size       = '';
            $brand      = '';

            $size         = DB::table('fashionrecovery.GR_020')
                                    ->where('SizeID',$item->SizeID)
                                    ->first()->SizeName;

            $brand  = DB::table('fashionrecovery.GR_017')
                        ->where('BrandID',$item->BrandID)
                        ->first()->BrandName;

            $item->size       = $size;
            $item->brand      = $brand;

            return $item;
        }); */
    }

    public static function thumbs($all) {

        return DB::table('fashionrecovery.GR_032')
                    ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                    ->where('IsCover',true)
                    ->get()
                    ->groupBy('ItemID');
    }

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
