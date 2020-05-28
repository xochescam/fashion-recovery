<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Gate;

use App\Item;

class WishlistController extends Controller
{
    protected $table = 'fashionrecovery.GR_024';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('show-favoritos')) {
            abort(403);
        }

        $type = 'card';
        $items = [];
        $wishlist = Auth::User()->getWishlists() !== null ? 
                    Auth::User()->getWishlists() : null;


        if($wishlist) {

            $itemsWishlist = DB::table('fashionrecovery.GR_037')
                                ->where('WishlistID',$wishlist->WishListID)
                                ->get()->groupBy('ItemID')->keys();
        
            $all = $this->getAllItems($itemsWishlist); 
            $thumbs = Item::getThumbs($all);
            $items  = Item::getItemThumbs($all, $thumbs)->toArray(); 

        }

        return view('wishlist.list',compact('wishlist','items','type'));
    }

    public function getAllItems($itemsWishlist) {

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_030', 'GR_029.ClosetID', '=', 'GR_030.ClosetID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->whereIn('GR_029.ItemID',$itemsWishlist)
                    ->where('GR_001.IsPaused',0)
                    ->where('GR_001.IsBlocked',false)
                    ->where('GR_029.IsPaused',0)
                    ->where('GR_030.IsPaused',0)
                    ->select('GR_029.ItemID','GR_029.OffSaleID','GR_029.CreationDate',
                             'GR_029.ItemDescription','GR_029.OriginalPrice','GR_029.ActualPrice',
                             'GR_018.ColorName','GR_029.BrandID','GR_029.SizeID')
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
            $item->otherBrand = $otherBrand;

            return $item;
        });
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
    public function store($ItemID)
    {
        if (Gate::denies('show-favoritos')) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            $data = $this->getData();

            $wishlist = DB::table($this->table)
                        ->where("UserID",Auth::User()->id)
                        ->first();

            if(!isset($wishlist->WishListID)) {
                DB::table($this->table)->insert($data);

                $wishlist = DB::table($this->table)
                            ->where('UserID',Auth::User()->id)
                            ->orderBy('CreationDate', 'desc')
                            ->first();
            }


            DB::table('fashionrecovery.GR_037')->insert([
                'ItemID'     => $ItemID,
                'WishlistID' => $wishlist->WishListID
            ]);

            $message = 'Prenda agregada correctamente a '.$wishlist->NameList;
            $url     = 'items/'.$ItemID.'/public';
            
            DB::commit();

            return response()->json("success");
 
        } catch (\Exception $ex) {

            DB::rollback();

            return response()->json("error");
        }
    }

    public function addToWishlist($WishlistID, $ItemID){

        DB::table('fashionrecovery.GR_037')->insert([
                'ItemID'     => $ItemID,
                'WishlistID' => $WishlistID
            ]);

        return response()->json([
            'message' => "success", 
            'url' => Item::getWishlistUrl($ItemID)
        ]);
    }

    public function removeFromWishlist($WishlistID, $ItemID){ //where and delete

        DB::table('fashionrecovery.GR_037')
            ->where('ItemID','=',$ItemID)
            ->where('WishlistID','=',$WishlistID)
            ->delete();

        return response()->json([
            'message' => "success", 
            'url' => Item::getWishlistUrl($ItemID)
        ]);
    }

    public function existingWishlist($WishlistID, $ItemID){

        $wishlist = DB::table($this->table)
                        ->where('WishListID',$WishlistID)
                        ->first();

        $exists = DB::table('fashionrecovery.GR_037')
                    ->where('ItemID',$ItemID)
                    ->where('WishlistID',$WishlistID)
                    ->first();

        if(isset($exists)){
            Session::flash('warning','Ya has agregado esta prenda a '.$wishlist->NameList);
            return Redirect::back();
            //return Redirect::to('items/'.$ItemID.'/public');
        }

        DB::table('fashionrecovery.GR_037')->insert([
                'ItemID'     => $ItemID,
                'WishlistID' => $WishlistID
            ]);

        Session::flash('success','Prenda agregada correctamente a '.$wishlist->NameList);
        return Redirect::back();
            //return Redirect::to('items/'.$ItemID.'/public');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('show-favoritos')) {
            abort(403);
        }

         $wishlist = DB::table($this->table)
                    ->where('WishListID',$id)
                    ->first();

         $itemsIds = DB::table('fashionrecovery.GR_037')
                        ->where('WishlistID',$id)
                        ->get()
                        ->groupBy('ItemID')
                        ->keys()
                        ->toArray();

        $allItems  = $this->getAllItems($itemsIds);

        $thumbs = $this->getItemThumbs($allItems);

        $items = $allItems->map(function ($item, $key) use($thumbs) {

            $item->ThumbPath = $thumbs[$item->ItemID]->first()->ThumbPath;
                
            return $item;
         });

        return view('wishlist.show',compact('wishlist','items'));
    }

    public function getItemThumbs($all) {

        return DB::table('fashionrecovery.GR_032')
                ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                ->where('IsCover',true)
                ->get()
                ->groupBy('ItemID');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('show-favoritos')) {
            abort(403);
        }

        $Wishlist = DB::table($this->table)
                    ->where('WishListID',$id)
                    ->first();

        return view('wishlist.edit',compact('Wishlist'));
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
        if (Gate::denies('show-favoritos')) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('WishListID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente el wishlist.');

            DB::commit();

            return Redirect::to('wishlists');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('wishlists');
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
        if (Gate::denies('delete-favoritos')) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            $explode     = explode('.', $this->table);
            $stringTable = $explode[0].'."'.$explode[1].'"';

            DB::delete('DELETE FROM '.$stringTable.' WHERE "WishListID"='.$id);

            DB::delete('DELETE FROM fashionrecovery."GR_037" WHERE "WishlistID"='.$id);


            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el wishlist');
            return Redirect::to('wishlists');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('wishlists');
        }
    }

    public function getData() {

        return [
             'UserID'       => Auth::User()->id,
             'NameList'     => 'Mis Favoritos',
             'Active'       => 1,
             'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
