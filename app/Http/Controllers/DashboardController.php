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
        
/*         $hasOffers = $this->getItemOffer($allItems);
 */
/* 		$items = $hasOffers->count() > 0 ? 
				 $hasOffers->merge($this->getItemWithoutOffer($allItems)) :
                 $this->getItemWithoutOffer($allItems); */
        $items = $allItems;
                 
        $thumbs = $this->getItemThumbs($items);

        $items = $items->map(function ($item, $key) use($thumbs) {

        	$item->ThumbPath = $thumbs[$item->ItemID]->first()->ThumbPath;

		    return $item;
        });

        $type = "card";
            
        return view('dashboard.index',compact('items','type'));
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

            $discount = $offers[$item->OffSaleID][0]->Discount;
            $price    = floatval(ltrim($item->ActualPrice,'$'));
            
            $item->offer = $discount.'%';
            $item->PriceOffer = $price - ($price * $discount)/100;
            
            return $item;
        });
    }

    public function getItemWithoutOffer($items) {

    	return $items->filter(function ($item, $key) {

		    return $item->OffSaleID === null;
            
		})->sortByDesc('CreationDate');
    }

    public function getAllItems() {

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_030', 'GR_029.ClosetID', '=', 'GR_030.ClosetID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->where('GR_001.IsPaused',0)
                    ->where('GR_029.IsPaused',0)
                    ->where('GR_030.IsPaused',0)
                    ->select('GR_029.ItemID','GR_029.OffSaleID','GR_029.CreationDate','GR_029.ItemDescription','GR_029.OriginalPrice','GR_029.ActualPrice','GR_018.ColorName','GR_029.BrandID','GR_029.SizeID')
                    ->get();

        return $items->map(function ($item, $key) {

            $size = DB::table('fashionrecovery.GR_020')
                        ->where('SizeID',$item->SizeID)
                        ->first()->SizeName;

            $brand = DB::table('fashionrecovery.GR_017')
                        ->where('BrandID',$item->BrandID)
                        ->first()->BrandName;

            $item->size  = $size;
            $item->brand = $brand;

            return $item;
        });
    }

    public function getItemThumbs($all) {

    	return DB::table('fashionrecovery.GR_032')
                ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                ->where('IsCover',true)
                ->get()
                ->groupBy('ItemID');
    }
}
