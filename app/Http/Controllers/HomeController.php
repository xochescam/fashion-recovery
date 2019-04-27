<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        })->take(16);
                                        
        return view('home',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
                    ->select('GR_029.ItemID','GR_029.OffSaleID','GR_029.CreationDate','GR_029.OriginalPrice','GR_029.ActualPrice','GR_020.SizeName','GR_018.ColorName','GR_017.BrandName')
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
