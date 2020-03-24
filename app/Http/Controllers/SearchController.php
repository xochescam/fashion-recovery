<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

use App\Item;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }

    public function search(Request $request, $search)
    {
        return view('search.search', compact('search'));
    }

    public function getItemThumbs($all) {

    	return DB::table('fashionrecovery.GR_032')
                ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                ->where('IsCover',true)
                ->get()
                ->groupBy('ItemID');
    }

    public function searchByLink($type, $search) {

        $types = [
            'departments' => [
                'id'     => 'DepartmentID',
                'table'  => 'GR_025',
                'name'   => 'DepName' 
            ],
            'brands' => [
                'id'     => 'BrandID',
                'table'  => 'GR_017',
                'name'   => 'BrandName' 
            ]
        ];                          
                                              
        $all   = $this->getItems()
                    ->where($types[$type]['table'].'.'.$types[$type]['name'], '=', $search);
        $thumbs = Item::getThumbs($all->get());
        $items  = Item::getItemThumbs($all->get(), $thumbs);

        $filters = $this->filterOptionsLink($all, $search);

        $type = 'card';

        return view('search.search', compact('search',
                                             'items',
                                             'filters',
                                             'type'));
    }

    public function filter(Request $request) {

        $filtersOpts = [
            'departments'   => $this->getChecked($request->departments),
            'clothingTypes' => $this->getChecked($request->clothingTypes),
            'brands'        => $this->getChecked($request->brands),
            'colors'        => $this->getChecked($request->colors)
        ];

        $all   = $this->getFiltredItems($this->getItems(), $filtersOpts);
        $thumbs = Item::getThumbs($all->get());
        $items  = Item::getItemThumbs($all->get(), $thumbs);

        $filters = $this->filterOptions($all, $filtersOpts);

        return response()->json([
            'filters' => $filters,
            'items'   => $items
        ]);
    }

    public function getFiltredItems($items, $filters) {

        if(count($filters['departments']) > 0) {
            $items = $this->getItems()->whereIn('GR_025.DepName',$filters['departments']);
        }

        if(count($filters['clothingTypes']) > 0) {
            $items = $this->getItems()->whereIn('GR_019.ClothingTypeName',$filters['clothingTypes']);
        }

        if(count($filters['brands']) > 0) {
            $items = $this->getItems()->whereIn('GR_017.BrandName',$filters['brands']);
        }

        if(count($filters['colors']) > 0) {
            $items = $this->getItems()->whereIn('GR_018.ColorName',$filters['colors']);
        }

        return $items;
    }

    public function getChecked($item) {
        return $item !== null ? explode(',',$item) : [];
    }

    public function getItemsInfo($items) {

        return DB::table('fashionrecovery.GR_032')
                    ->whereIn('ItemID',$items->groupBy('ItemID')->keys())
                    ->get(['PicturePath','ThumbPath','ItemID'])
                    ->groupBy('ItemID');
    }

    public function addChecked($data, $key, $ids) {

        return $data->map(function ($itemData, $keyData) use($ids, $key) {

            $data = $itemData->whereIn($key, $ids);

            foreach ($data as $key => $value) {

                $value->isChecked = true;
            }

            return $itemData;
        });
    }

    public function getItems() {

        return DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_030', 'GR_029.ClosetID', '=', 'GR_030.ClosetID')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->where('GR_001.IsPaused',0)
                    ->where('GR_029.IsPaused',0)
                    ->where('GR_030.IsPaused',0)
                    ->select('GR_029.ItemDescription', 
                             'GR_029.ItemID',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_020.SizeName as size',
                             'GR_018.ColorName',
                             'GR_018.ColorID',
                             'GR_017.BrandName as brand',
                             'GR_017.BrandID',
                             'GR_025.DepName',
                             'GR_025.DepartmentID',
                             'GR_019.ClothingTypeName',
                             'GR_017.BrandID',
                             'GR_019.ClothingTypeID');
    }

    public function filterOptions($items, $options) {

        $departments   = $this->getFiltredKeys('DepName', 'DepartmentID', $items);
        $clothingTypes = $this->getFiltredKeys('ClothingTypeName', 'ClothingTypeID', $items);
        $brands        = $this->getFiltredKeys('brand', 'BrandID', $items);
        $colors        = $this->getFiltredKeys('ColorName', 'ColorID', $items);

        return [
            'departments'   => $this->checked($departments, $options['departments']),
            'brands'        => $this->checked($brands, $options['brands']),
            'clothingTypes' => $this->checked($clothingTypes, $options['clothingTypes']),
            'colors'        => $this->checked($colors, $options['colors'])
        ];
    }

    public function filterOptionsLink($items, $search) {

        $departments   = $this->getFiltredKeys('DepName', 'DepartmentID', $items);
        $clothingTypes = $this->getFiltredKeys('ClothingTypeName', 'ClothingTypeID', $items);
        $brands        = $this->getFiltredKeys('brand', 'BrandID', $items);
        $colors        = $this->getFiltredKeys('ColorName', 'ColorID', $items);

        return [
            'departments'   => $this->checkedAttr($departments, $search),
            'brands'        => $this->checkedAttr($brands, $search),
            'clothingTypes' => $this->checkedAttr($clothingTypes, $search),
            'colors'        => $this->checkedAttr($colors, $search)
        ];
    }

    public function getFiltredKeys($name, $id, $items) {

        $keys = $items->orderBy($name)->get()->groupBy($name);

        return $keys->map(function ($item, $key) use ($id) {

            return [
                'id'    => $item->first()->$id,
                'count' => count($item)
            ];

            return count($item);
        });
    }

    public function checked($filter, $options) {

        return $filter->map(function ($item, $key) use ($options) {

            $checked = false;
            $keyOpt = null;

            foreach ($options as $value) {
                if($value == $key) {
                    $checked = true;
                }
            }

            return [

                'id'      => $item['id'],
                'checked' => $checked,
                'count'   => $item['count']
            ];

        })->toArray();
    }

    public function checkedAttr($filter, $search) {

        return $filter->map(function ($item, $key) use ($search) {

            return [
                'id'      => $item['id'],
                'checked' => $search == $key,
                'count'   => $item['count']
            ];
        })->toArray();
    }

    public function getWishlist($item) {

        $user = Auth::User();
        $id = $item->ItemID;

        return !isset($user->id) ? 'login/0' :
                    (!$user->getWishlists() ? 'wishlist/'.$id.'/create' : 
                    ($user->inWishlist($id) ? 
                    'wishlist/'.$user->getWishlists()->WishListID.'/'.$id.'/delete':
                    'wishlist/'.$user->getWishlists()->WishListID.'/'.$id.'/add'));
    }

}
