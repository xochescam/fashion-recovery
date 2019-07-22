<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }

    public function search(Request $request)
    {
        $search = $request->get('criteria');

        if(strpos($search, ' ') !== false) {
            $search = str_replace(' ', '%', $search);
        }

        $items = $this->getItems($search);

        $departments   = $items->orderBy('GR_025.DepName')->get()->groupBy('DepName');
        $brands        = $items->orderBy('GR_017.BrandName')->get()->groupBy('BrandName');
        $clothingTypes = $items->orderBy('GR_019.ClothingTypeName')->get()->groupBy('ClothingTypeName');
        $colors        = $items->orderBy('GR_018.ColorName')->get()->groupBy('ColorName');

        $items = $items->get();

        $itemsInfo = $this->getItemsInfo($items);

        return view('search.search', compact('search',
                                             'itemsInfo',
                                             'items',
                                             'departments',
                                             'brands',
                                             'clothingTypes',
                                             'colors'));
    }


    public function filter(Request $request) {

        $departmentsIds   = isset($request->DepartmentID) ? $request->DepartmentID : false;
        $brandsIds        = isset($request->BrandID) ? $request->BrandID : false;
        $clothingTypesIds = isset($request->ClothingTypeID) ? $request->ClothingTypeID : false;
        $actualPrice      = isset($request->ActualPrice) ? $request->ActualPrice : false;
        $search           = $request->search;
        $result           = null;

        $items = $this->getItems($search);

        $departments   = $items->orderBy('GR_025.DepName')->get()->groupBy('DepName');
        $brands        = $items->orderBy('GR_017.BrandName')->get()->groupBy('BrandName');
        $clothingTypes = $items->orderBy('GR_019.ClothingTypeName')->get()->groupBy('ClothingTypeName');
        $colors        = $items->orderBy('GR_018.ColorName')->get()->groupBy('ColorName');

        if($departmentsIds) {

            $departments = $this->addChecked($departments, 'DepartmentID', $departmentsIds);
            $items       = $items->whereIn('fashionrecovery.GR_025.DepartmentID', $departmentsIds);
        }

        if($brandsIds) {

            $brands = $this->addChecked($brands, 'BrandID', $brandsIds);
            $items  = $items->whereIn('fashionrecovery.GR_017.BrandID', $brandsIds);
        }

        if($clothingTypesIds) {

            $clothingTypes = $this->addChecked($clothingTypes, 'ClothingTypeID', $clothingTypesIds);
            $items         = $items->whereIn('fashionrecovery.GR_019.ClothingTypeID', $clothingTypesIds);
        }

        if($actualPrice) {
            $items = $items->where('fashionrecovery.GR_029.ActualPrice','=',$actualPrice);
        }

        $items     = $items->get();
        $itemsInfo = $this->getItemsInfo($items);

        return view('search.search', compact('actualPrice',
                                             'search',
                                             'itemsInfo',
                                             'items',
                                             'departments',
                                             'brands',
                                             'clothingTypes',
                                             'colors'));
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

    public function getItemsInfo($items) {

        return DB::table('fashionrecovery.GR_032')
                    ->whereIn('ItemID',$items->groupBy('ItemID')->keys())
                    ->get(['PicturePath','ThumbPath','ItemID'])
                    ->groupBy('ItemID');
    }

    public function getItems($search) {

        return DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->select('fashionrecovery.GR_029.ItemDescription', 'GR_029.ItemID','GR_029.OriginalPrice','GR_029.ActualPrice','GR_020.SizeName','GR_018.ColorName','GR_018.ColorID','GR_017.BrandName','GR_017.BrandID','GR_025.DepName','GR_025.DepartmentID','GR_019.ClothingTypeName','GR_019.ClothingTypeID')
                    ->where('fashionrecovery.GR_017.BrandName', 'LIKE', '%'.$search.'%');
                    // ->orWhere('fashionrecovery.GR_029.ItemDescription', 'LIKE', '%'.$search.'%')
                    // ->orWhere('fashionrecovery.GR_018.ColorName', 'LIKE', '%'.$search.'%');
    }
}
