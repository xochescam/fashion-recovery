<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;

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
        $wishlist = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->orderBy('CreationDate', 'desc')
                        ->get();

        $itemsWishlist = DB::table('fashionrecovery.GR_037')
                        ->whereIn('WishlistID',$wishlist->groupBy('WishListID')->keys()->toArray())
                        ->get();

        if(count($itemsWishlist) > 0) {

            $wishlists = $wishlist->map(function ($item, $key) use($itemsWishlist){

                $itemsIds = $itemsWishlist->where('WishlistID',$item->WishListID)
                                          ->groupBy('ItemID')
                                          ->keys()
                                          ->toArray();

                $items = DB::table('fashionrecovery.GR_032')
                        ->whereIn('ItemID',$itemsIds)
                        ->get()
                        ->groupBy('ItemID');

                return [
                    'WishListID' => $item->WishListID,
                    'NameList'   => $item->NameList,
                    'IsPublic'   => $item->IsPublic,
                    'Active'     => $item->Active,
                    'Items'      => count($items) == 0 ? null : $items
                ];
            });
        } else {

            $wishlists = $wishlist->map(function ($item, $key) {

                return [
                    'WishListID' => $item->WishListID,
                    'NameList'   => $item->NameList,
                    'IsPublic'   => $item->IsPublic,
                    'Active'     => $item->Active,
                    'Items'      => null
                ];
            });
        }

        return view('wishlist.list',compact('wishlists'));
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

        DB::beginTransaction();

        try {

            $message = 'Wishlist creada correctamente';
            $url     = 'wishlists';

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            if(isset($request->ItemID)) {
                $lastWishlist = DB::table($this->table)
                                ->where('UserID',Auth::User()->id)
                                ->orderBy('CreationDate', 'desc')
                                ->first();

                DB::table('fashionrecovery.GR_037')->insert([
                    'ItemID'     => $request->ItemID,
                    'WishlistID' => $lastWishlist->WishListID
                ]);

                $message = 'Prenda agregada correctamente a '.$lastWishlist->NameList;
                $url     = 'items/'.$request->ItemID.'/public';
            }

            DB::commit();

            Session::flash('success',$message);
            return Redirect::back();
            //return Redirect::to($url);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::back();
            //return Redirect::to('items/'.$request->ItemID.'/public');
        }
    }

    public function addToWishlist($WishlistID, $ItemID){

        DB::table('fashionrecovery.GR_037')->insert([
                'ItemID'     => $ItemID,
                'WishlistID' => $WishlistID
            ]);

        return response()->json("success");
    }

    public function removeFromWishlist($WishlistID, $ItemID){ //where and delete

        DB::table('fashionrecovery.GR_037')
            ->where('ItemID','=',$ItemID)
            ->where('WishlistID','=',$WishlistID)
            ->delete();

        return response()->json("success");
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
            Session::flash('warning','Ya has guardado esta prenda en '.$wishlist->NameList);
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

    public function getAllItems($itemsIds) {

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_030', 'GR_029.ClosetID', '=', 'GR_030.ClosetID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->where('GR_001.IsPaused',0)
                    ->where('GR_029.IsPaused',0)
                    ->where('GR_030.IsPaused',0)
                    ->whereIn('GR_029.ItemID',$itemsIds)
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    public function getData($data) {

        return [
             'UserID'       => Auth::User()->id,
             'NameList'     => $data['NameList'],
             'IsPublic'     => isset($data['IsPublic']) ? 1 : 0,
             'Active'       => 1,
             'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
