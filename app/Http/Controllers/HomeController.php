<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ErrorPackPack;

use Auth;
use DB;
use Session;
use Redirect;
use Mail;

use App\Item;
use App\Newsletter;
use App\User;
use App\PackPack;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all  = $this->getAllItems();
        $type = "card";

        $thumbs = Item::getThumbs($all);
        $items  = Item::getItemThumbs($all, $thumbs)->take(16); 

        return view('home',compact('items','type'));
    }

    public function newsletter(Request $request)
    {
        $this->validator($request);

        $exists = Newsletter::where('email',$request->email)->first();

        if(!isset($exists->email)) {
            DB::table('fashionrecovery.GR_043')
                ->insert([
                    'email' => $request->email,
                ]);
        }

        Session::flash('success','¡Te mantendrémos informado de las noticias!');
        return Redirect::to('/');
    }

    protected function validator($request)
    {
        $request->validate([
            'email' => ['required','email'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        
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
                    ->where('GR_001.IsBlocked',false)
                    ->where('GR_029.IsPaused',0)
                    ->where('GR_030.IsPaused',0)
                    ->where('GR_029.IsSold',0)
                    ->select('GR_029.ItemID','GR_029.OffSaleID','GR_029.CreationDate',
                             'GR_029.ItemDescription','GR_029.OriginalPrice','GR_029.ActualPrice',
                             'GR_018.ColorName','GR_029.BrandID','GR_029.SizeID')
                    ->get();

        $keys = $items->groupBy('ItemID')->keys();
        $wish = DB::table('fashionrecovery.GR_037')
                    ->whereIn('ItemID',$keys)
                    ->get()->groupBy('ItemID');
            
        $counted = $wish->sortByDesc(function ($item) {
                return count($item);
            });

        return $items->map(function ($item, $key) use ($counted) {

            $size       = '';
            $brand      = '';
            $otherBrand = '';
            $count = 0;

           if(isset($item->BrandID)) {

                $size         = DB::table('fashionrecovery.GR_020')
                                    ->where('SizeID',$item->SizeID)
                                    ->first()->SizeName;

                $brand         = DB::table('fashionrecovery.GR_017')
                                    ->where('BrandID',$item->BrandID)
                                    ->first()->BrandName;
            } else {

               $otherBrand = DB::table('fashionrecovery.GR_036')
                                ->where('ItemID',$item->ItemID)
                                ->first();
            }


            foreach ($counted as $key => $value) {
                if($item->ItemID === $key) {
                    $count = count($value);
                }
            }

            $item->size       = $size;
            $item->brand      = $brand;
            $item->otherBrand = $otherBrand;
            $item->count = $count;

            return $item;
        })->SortByDesc('count');
    }

    public function getItemThumbs($all) {

        return DB::table('fashionrecovery.GR_032')
                ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                ->where('IsCover',true)
                ->get()
                ->groupBy('ItemID');
    }
}
