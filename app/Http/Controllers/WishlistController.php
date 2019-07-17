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

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            $lastWishlist = DB::table($this->table)
                                ->where('UserID',Auth::User()->id)
                                ->orderBy('CreationDate', 'desc')
                                ->first();          

            DB::table('fashionrecovery.GR_037')->insert([
                'ItemID'     => $request->ItemID,
                'WishlistID' => $lastWishlist->WishListID
            ]);

            DB::commit();

            Session::flash('success','Prenda agregada correctamente a '.$lastWishlist->NameList);
            return Redirect::to('items/'.$request->ItemID.'/public');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('items/'.$request->ItemID.'/public');
        }
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
            return Redirect::to('items/'.$ItemID.'/public');
        }

        DB::table('fashionrecovery.GR_037')->insert([
                'ItemID'     => $ItemID,
                'WishlistID' => $WishlistID
            ]);

        Session::flash('success','Prenda agregada correctamente a '.$wishlist->NameList);
            return Redirect::to('items/'.$ItemID.'/public');
        
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
             'IsPublic'     => isset($data['IsPublic'])  ? 1 : 0,
             'Active'       => 1,
             'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
