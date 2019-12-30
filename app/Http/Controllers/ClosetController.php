<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;

use App\Item;


class ClosetController extends Controller
{
    protected $table = 'fashionrecovery.GR_030';


    public function ownClosets() {

        $allClosets = Auth::User()->getCollections();
        $closetIds  = $allClosets->groupBy('ClosetID')->keys();
        $closets    = $this->getItemsByCloset($closetIds);

        $items      = $this->getAllItems();        

        return view('dashboard.ownClosets',compact('closets','items'));
    }

    function getItemsByCloset($closetIds) {

        return DB::table('fashionrecovery.GR_029')
                ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                ->where('GR_032.IsCover',true)
                ->whereIn('GR_029.ClosetID',$closetIds)
                ->select('GR_032.ThumbPath')
                ->get();
    }

    function getAllItems() {

        return DB::table('fashionrecovery.GR_029')
                ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                ->where('GR_032.IsCover',true)
                ->where('GR_029.OwnerID',Auth::User()->id)
                ->select('GR_032.ThumbPath')
                ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $closets = DB::table($this->table)
                    ->where('UserID',Auth::User()->id)
                    ->get();

        $all = DB::table('fashionrecovery.GR_029')
                ->whereIn('GR_029.ClosetID',$closets->groupBy('ClosetID')->keys()->toArray())
                ->where('GR_029.OwnerID',Auth::User()->id)
                ->get();

        $thumbs = Item::getThumbs($all);
        $items  = Item::getItemThumbs($all, $thumbs)
                        ->groupBy('ClosetID')->toArray();  

        return view('closet.list',compact('closets','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('closet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente la colección.');
            return Redirect::to('closets');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('closet');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $closet = DB::table($this->table)->where('ClosetID',$id)->first();

        $items  = $this->getMyItems($id);

        $thumbs = $this->getItemThumbs($items);

        $items = $items->map(function ($item, $key) use($thumbs) {

            $item->ThumbPath = $thumbs[$item->ItemID][0]->ThumbPath;

            return $item;
        });
        

        return view('closet.show',compact('items','closet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $closet = DB::table($this->table)
                    ->where('ClosetID',$id)
                    ->first();

        return view('closet.edit',compact('closet'));
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
        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('ClosetID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente la colección.');

            DB::commit();

            return Redirect::to('closets');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('closets');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = DB::table($this->table)
                    ->where('ClosetID',$id)
                    ->first()
                    ->ClosetName;

        DB::beginTransaction();

        try {

            $explode     = explode('.', $this->table);
            $stringTable = $explode[0].'."'.$explode[1].'"';

            DB::delete('DELETE FROM '.$stringTable.' WHERE "ClosetID"='.$id);
            
            $default = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->where('ClosetName','Closet por defecto')
                        ->first();

            if(!isset($default)) {
                $closet = DB::table($this->table)->insert([
                    'UserID'            => Auth::User()->id,
                    'ClosetName'        => 'Closet por defecto',
                    'ClosetDescription' => 'Closet por defecto',
                    'CreationDate'      => date("Y-m-d H:i:s")
                ]);

                $default = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->where('ClosetName','Closet por defecto')
                        ->first();
            }

            $items = DB::table('fashionrecovery.GR_029')
                        ->where('OwnerID',Auth::User()->id)
                        ->where('ClosetID',$id)
                        ->get();

            foreach ($items as $key => $item) {
                DB::table('fashionrecovery.GR_029')
                        ->where('ItemID',$item->ItemID)
                        ->update(['ClosetID' => $default->ClosetID]);
            }

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente la colección '.$name.'.');
            return Redirect::to('closets');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('closets');
        }
    }


    public function getData($data) {

        return [
            'UserID'            => Auth::User()->id,
            'ClosetName'        => $data['ClosetName'],
            'ClosetDescription' => $data['ClosetDescription'],
            'CreationDate'      => date("Y-m-d H:i:s"),
            'IsPaused'          => false
        ];
    }

    public function getMyItems($closetIds) {

        $items = DB::table('fashionrecovery.GR_029')
                    //->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    //->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_030', 'GR_029.ClosetID', '=', 'GR_030.ClosetID')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->whereIn('fashionrecovery.GR_030.ClosetID',$closetIds)
                    ->select('GR_029.IsPaused','GR_029.ItemID','GR_029.OffSaleID','GR_029.CreationDate','GR_029.ItemDescription','GR_029.OriginalPrice','GR_029.ActualPrice','GR_018.ColorName','GR_029.BrandID','GR_029.SizeID')
                    ->get();

        return $items->map(function ($item, $key) {

            $size       = '';
            $brand      = '';
            $otherBrand = '';

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

            $item->size       = $size;
            $item->brand      = $brand;
            $item->otherBrand      = $otherBrand;

            return $item;
        });
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

            $item->offer = $discount.'%';
            $item->PriceOffer = $item->ActualPrice - ($item->ActualPrice * $discount)/100;

            return $item;
        });
    }

    public function getItemWithoutOffer($items) {

        return $items->filter(function ($item, $key) {

            return $item->OffSaleID === null;
            
        })->sortByDesc('CreationDate');
    }

    public function getItemThumbs($all) {

        return DB::table('fashionrecovery.GR_032')
                    ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                    ->get()
                    ->groupBy('ItemID')
                    ->toArray();
    }

    
}
