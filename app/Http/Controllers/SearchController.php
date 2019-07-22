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

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->select('fashionrecovery.GR_029.ItemDescription', 'GR_029.ItemID','GR_029.OriginalPrice','GR_029.ActualPrice','GR_020.SizeName','GR_018.ColorName','GR_018.ColorID','GR_017.BrandName','GR_017.BrandID','GR_025.DepName','GR_025.DepartmentID','GR_019.ClothingTypeName','GR_019.ClothingTypeID')
                    ->where('fashionrecovery.GR_017.BrandName', 'LIKE', '%'.$search.'%')
                    ->orWhere('fashionrecovery.GR_029.ItemDescription', 'LIKE', '%'.$search.'%')
                    ->orWhere('fashionrecovery.GR_018.ColorName', 'LIKE', '%'.$search.'%');

        $departments   = $items->orderBy('GR_025.DepName')->get()->groupBy('DepName');
        $brands        = $items->orderBy('GR_017.BrandName')->get()->groupBy('BrandName');
        $clothingTypes = $items->orderBy('GR_019.ClothingTypeName')->get()->groupBy('ClothingTypeName');
        $colors        = $items->orderBy('GR_018.ColorName')->get()->groupBy('ColorName');

        $items = $items->get();

        $itemsInfo = DB::table('fashionrecovery.GR_032')
                        ->whereIn('ItemID',$items->groupBy('ItemID')->keys())
                        ->get(['PicturePath','ThumbPath','ItemID'])
                        ->groupBy('ItemID');

        return view('search.search', compact('itemsInfo',
                                             'items',
                                             'departments',
                                             'brands',
                                             'clothingTypes',
                                             'colors'));
    }
}
