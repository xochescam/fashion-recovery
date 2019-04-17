<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;


use DB;
use Redirect;
use Session;
use Auth;
use Image;

class ItemController extends Controller
{
    protected $table = 'fashionrecovery.GR_029';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table($this->table)
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->join('fashionrecovery.GR_031', 'GR_029.OffSaleID', '=', 'GR_031.OfferID')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->select('GR_029.ItemID','GR_032.ItemPictureID','GR_032.PicturePath','GR_031.Discount','GR_029.OriginalPrice','GR_029.ActualPrice')
                    ->get()
                    ->groupBy('ItemID');

        return view('item.list',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors        = DB::table('fashionrecovery.GR_018')->get();
        $sizes         = DB::table('fashionrecovery.GR_020')->get();
        $clothingTypes = DB::table('fashionrecovery.GR_019')->get();
        $departments   = DB::table('fashionrecovery.GR_025')->get();
        $categories    = DB::table('fashionrecovery.GR_026')->get();
        $types         = DB::table('fashionrecovery.GR_027')->get();
        $closets       = DB::table('fashionrecovery.GR_030')->get();
        $offers        = DB::table('fashionrecovery.GR_031')->get();

        return view('item.create',compact(
            'colors',
            'sizes',
            'clothingTypes',
            'departments',
            'categories',
            'types',
            'closets',
            'offers'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //DB::beginTransaction();

        //try {

            $data = $this->itemData($request->toArray());

            DB::table($this->table)->insert($data);
            $id = DB::getPdo()->lastInsertId(); //change

            $itemsName = $this->saveItems($request->toArray(), $id);

            foreach ($itemsName as $key => $value) { //change

                DB::table('fashionrecovery.GR_032')->insert([
                    'ItemID' => $id,
                    'PicturePath' => $value,
                    'CreationDate' => date("Y-m-d H:i:s")
                ]);
            }

            //DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('item'); //cambiar

        //} catch (\Exception $ex) {

            //DB::rollback();

            //Session::flash('warning','Ha ocurrido un error');
            //return Redirect::to('seller');
        //}
    }


    protected function itemData($data) {

        $closet = $data['ClosetID'] == "default" ?
                    $this->saveDefaultCloset()->ClosetID :
                    $data['ClosetID'];

        return [
             'OwnerID'          => Auth::User()->id,
             'PicturesUploaded' => count($data['PicturesUploaded']),
             'OriginalPrice'    => $data['OriginalPrice'],
             'ActualPrice'      => $data['ActualPrice'],
             'ColorID'          => $data['ColorID'],
             'SizeID'           => $data['SizeID'],
             'ClothingTypeID'   => $data['ClothingTypeID'],
             'DepartmentID'     => $data['DepartmentID'],
             'CategoryID'       => $data['CategoryID'],
             'TypeID'           => $data['TypeID'],
             'ClosetID'         => $closet,
             'OffSaleID'        => $data['OffSaleID'],
             'CreationDate'     => date("Y-m-d H:i:s")
        ];
    }

    protected function saveDefaultCloset() {
        $table = 'fashionrecovery.GR_030';
        $userID = Auth::User()->id;

        DB::table($table)
            ->insert([
                'ClosetName'   => 'Closet por defecto',
                'UserID'       => $userID,
                'CreationDate' => date("Y-m-d H:i:s"),
            ]);

        return  DB::table($table)
                    ->where('UserID',$userID)
                    ->first();
    }

    /* Save items to disk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function saveItems($data,$item) {

        $itemsName = [];
        $count     = 0;

        foreach ($data['PicturesUploaded'] as $key => $value) {

            $date   = date("Ymd-His");
            $dir = 'sellers/'.Auth::User()->id.'/items/'.$item.'/';
            $name = $date.'-'.$count++.'.jpg';
            $img = Image::make($value->getRealPath())->fit(200);
            $img->stream();
            //eliminar carpeta al actualizar
            \Storage::disk('public')->put($dir.$name,  \File::get($value));
            \Storage::disk('public')->put($dir.'thumb-'.$name, $img, 'public');
            array_push($itemsName,$dir.$name);
        }

        return $itemsName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $db = 'fashionrecovery';

        $item = DB::table($this->table) //Mostrar solo una imagen
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_031', 'GR_029.OffSaleID', '=', 'GR_031.OfferID')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_026', 'GR_029.CategoryID', '=', 'GR_026.CategoryID')
                    ->join('fashionrecovery.GR_027', 'GR_029.TypeID', '=', 'GR_027.TypeID')
                    ->join('fashionrecovery.GR_030', 'GR_029.ClosetID', '=', 'GR_030.ClosetID')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->where('GR_029.ItemID',$id)
                    ->select('GR_029.ItemID',
                             'GR_032.ItemPictureID',
                             'GR_032.PicturePath',
                             'GR_031.Discount',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_020.SizeName',
                             'GR_018.ColorName',
                             'GR_019.ClothingTypeName',
                             'GR_025.DepName',
                             'GR_026.CategoryName',
                             'GR_027.TypeName',
                             'GR_030.ClosetName'
                         )
                    ->get()->groupBy('ItemID')->first();


        return view('item.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item          = DB::table($this->table)->where('ItemID',$id)->first();
        $colors        = DB::table('fashionrecovery.GR_018')->get();
        $sizes         = DB::table('fashionrecovery.GR_020')->get();
        $clothingTypes = DB::table('fashionrecovery.GR_019')->get();
        $departments   = DB::table('fashionrecovery.GR_025')->get();
        $categories    = DB::table('fashionrecovery.GR_026')->get();
        $types         = DB::table('fashionrecovery.GR_027')->get();
        $closets       = DB::table('fashionrecovery.GR_030')->get();
        $offers        = DB::table('fashionrecovery.GR_031')->get();

        return view('item.edit',compact(
            'item',
            'colors',
            'sizes',
            'clothingTypes',
            'departments',
            'categories',
            'types',
            'closets',
            'offers'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $data = $this->itemData($request->toArray());

            DB::table($this->table)->where('ItemID',$id)->update($data);

            $itemsName = $this->saveItems($request->toArray(), $id);

            DB::delete('DELETE FROM fashionrecovery."GR_032" WHERE "ItemID"='.$id);

            foreach ($itemsName as $key => $value) { //change
                DB::table('fashionrecovery.GR_032')->insert([
                    'ItemID' => $id,
                    'PicturePath' => $value,
                    'CreationDate' => date("Y-m-d H:i:s")
                ]);
            }

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('item/'.$id); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('item/'.$id.'/edit');
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

            DB::delete('DELETE FROM fashionrecovery."GR_032" WHERE "ItemPictureID"='.$id);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el registro');
            return Redirect::to('items');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('item/'.$id);
        }
    }
}
