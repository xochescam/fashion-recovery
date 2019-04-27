<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class DashboardController extends Controller
{
 	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$allItems  = $this->getAllItems();
		$hasOffers = $this->getItemOffer($allItems);


		$items = $hasOffers->count() > 0 ? 
				 $hasOffers->merge($this->getItemWithoutOffer($allItems)) :
				 $this->getItemWithoutOffer($allItems);

		$thumbs = $this->getItemThumbs($items);

        $items = $items->map(function ($item, $key) use($thumbs) {

        	$item->ThumbPath = $thumbs[$item->ItemID][0]->ThumbPath;

		    return $item;
		});
        
        return view('dashboard.index',compact('items'));
    }

    public function getItemOffer($items) {

    	$items = $items->filter(function ($item, $key) {

		    return $item->OffSaleID !== null;
		});

		$offers = DB::table('fashionrecovery.GR_031')
					->whereIn('OfferID',$items->groupBy('OffSaleID')
					->keys())
					->get()
					->groupBy('OfferID')
					->toArray();

		return $items->map(function ($item, $key) use ($offers) {

			$item->offer = $offers[$item->OffSaleID][0]->Discount.'%';

		    return $item;
		});
    }

    public function getItemWithoutOffer($items) {

    	return $items->filter(function ($item, $key) {

		    return $item->OffSaleID === null;
            
		})->sortByDesc('CreationDate');
    }

    public function getAllItems() {

		return DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->select('GR_029.ItemID','GR_029.OffSaleID','GR_029.OriginalPrice','GR_029.CreationDate','GR_029.ActualPrice','GR_020.SizeName','GR_018.ColorName','GR_017.BrandName')
                    ->get();
    }

    public function getItemThumbs($all) {

    	return DB::table('fashionrecovery.GR_032')
        			->whereIn('ItemID',$all->groupBy('ItemID')->keys())
        			->get()
        			->groupBy('ItemID')
        			->toArray();
    }
}
