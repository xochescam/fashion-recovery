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
        $products = DB::table('fashionrecovery.GR_029')
            ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
            ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
            ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
            ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
            ->select('GR_029.ItemID','GR_032.ItemPictureID','GR_032.PicturePath','GR_032.ThumbPath','GR_029.OriginalPrice','GR_029.ActualPrice','GR_020.SizeName','GR_018.ColorName','GR_017.BrandName')
            ->where('fashionrecovery.GR_017.BrandName', 'LIKE', '%'.$search.'%')
            ->get()
            ->groupBy('ItemID');
        // dd($products);
        return view('search.search', compact('products'));
    }
}
