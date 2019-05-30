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
                   ->where('GR_029.OwnerID',Auth::User()->id)
                   ->select('GR_029.ItemID','GR_032.ItemPictureID','GR_032.PicturePath','GR_029.OriginalPrice','GR_029.ActualPrice','GR_032.ThumbPath','GR_029.ItemDescription')
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
        $item = false;
        $colors        = DB::table('fashionrecovery.GR_018')
                            ->where('Active',1)->get();
        //$sizes         = DB::table('fashionrecovery.GR_020')->get();
        $clothingTypes = DB::table('fashionrecovery.GR_019')
                            ->where('Active',1)->get();

        $departments   = DB::table('fashionrecovery.GR_025')
                            ->where('Active',1)->get();

        $categories    = DB::table('fashionrecovery.GR_026')
                            ->where('Active',1)->get();

        $styles        = DB::table('fashionrecovery.GR_035')
                            ->where('Active',1)->get();

        $types         = DB::table('fashionrecovery.GR_027')
                            ->where('Active',1)->get();

        //$brands        = DB::table('fashionrecovery.GR_017')->get();
        $offers        = DB::table('fashionrecovery.GR_031')->get();

        $closets       = DB::table('fashionrecovery.GR_030')
                            ->where('UserID',Auth::User()->id)
                            ->get();

        return view('item.create',compact(
            'item',
            'colors',
            'clothingTypes',
            'departments',
            'categories',
            'styles',
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


        DB::beginTransaction();

        try {

            $data = $this->itemData($request->toArray());

            DB::table($this->table)->insert($data);
            $id = DB::getPdo()->lastInsertId(); //change

            $itemsName = $this->saveItems($request->toArray(), $id);

            foreach ($itemsName as $key => $value) { //change

                DB::table('fashionrecovery.GR_032')->insert([
                    'ItemID' => $id,
                    'PicturePath' => $value['name'],
                    'ThumbPath' => $value['thumb'],
                    'CreationDate' => date("Y-m-d H:i:s")
                ]);
            }

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('items'); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('seller');
        }
    }

    protected function updateItemData($data) {

        $data['ValidFrom'] = date("Y-m-d H:i:s",strtotime($data['ValidFrom']));
        $data['ValidUntil'] = date("Y-m-d H:i:s",strtotime($data['ValidUntil']));

        $closet = !isset($data['ClosetID']) || $data['ClosetID'] == "default" ?
                    $this->saveDefaultCloset()->ClosetID :
                    $data['ClosetID'];

        $OffSaleID = isset($data['offer']) ? $this->saveOffer($data) : null;

        return [
             'ItemDescription'  => $data['ItemDescription'],
             'OwnerID'          => Auth::User()->id,
             //'PicturesUploaded' => count($data['PicturesUploaded']),
             //'OriginalPrice'    => $data['OriginalPrice'],
             //'ActualPrice'      => $data['ActualPrice'],
             'ColorID'          => $data['ColorID'],
             'SizeID'           => $data['SizeID'],
             'ClothingTypeID'   => $data['ClothingTypeID'],
             'DepartmentID'     => $data['DepartmentID'],
             'CategoryID'       => $data['CategoryID'],
             'ClothingStyleID'  => $data['ClothingStyleID'],
             'TypeID'           => $data['TypeID'],
             'BrandID'          => $data['BrandID'],
             'ClosetID'         => $closet,
             'OffSaleID'        => $OffSaleID,
             //'CreationDate'     => date("Y-m-d H:i:s")
        ];
    }

    protected function itemData($data) {

        $closet = !isset($data['ClosetID']) || $data['ClosetID'] == "default" ?
                    $this->saveDefaultCloset()->ClosetID :
                    $data['ClosetID'];

        $OffSaleID = isset($data['offer']) ? $this->saveOffer($data) : null;

        $countImg = 0;

        foreach ($data as $key => $value) {
            $name = explode('_', $key);

            if(count($name) > 2 &&
                $name[1].'_'.$name[2] == 'item_file') {
                $countImg++;
            }
        }

        return [
             'ItemDescription'  => $data['ItemDescription'],
             'OwnerID'          => Auth::User()->id,
             'PicturesUploaded' => $countImg,
             'OriginalPrice'    => $data['OriginalPrice'],
             'ActualPrice'      => $data['ActualPrice'],
             'ColorID'          => $data['ColorID'],
             'SizeID'           => $data['SizeID'],
             'ClothingTypeID'   => $data['ClothingTypeID'],
             'DepartmentID'     => $data['DepartmentID'],
             'CategoryID'       => $data['CategoryID'],
             'ClothingStyleID'  => $data['ClothingStyleID'],
             'TypeID'           => $data['TypeID'],
             'BrandID'          => $data['BrandID'],
             'ClosetID'         => $closet,
             'OffSaleID'        => $OffSaleID,
             'CreationDate'     => date("Y-m-d H:i:s")
        ];
    }

    public function saveOffer($data) {

        $offer = DB::table('fashionrecovery.GR_031')
                    ->insert([
                        'Discount'   => $data['Discount'],
                        'ValidFrom'  => $data['ValidFrom'],
                        'ValidUntil' => $data['ValidUntil'],
                        'UserID'     => Auth::User()->id
                    ]);

        return $id = DB::getPdo()->lastInsertId();
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
        $thumbName = [];
        $items = [];
        $count     = 0;

        foreach ($data as $key => $value) {

            $name = explode('_', $key);

            if(count($name) > 2 &&
                $name[1].'_'.$name[2] === "item_file") {

                $date   = date("Ymd-His");
                $dir = 'items/user_'.Auth::User()->id.'/item_'.$item.'/';
                $name = $date.'-'.$count++.'.jpg';
                //ini_set('memory_limit', "2000M");

                $realImg = Image::make($value->getRealPath())
                                ->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                });
                $realImg->stream();
                $img = Image::make($value->getRealPath())->fit(200);
                $img->stream();
                //ini_set('memory_limit', "256M");
                //eliminar carpeta al actualizar
                \Storage::disk('public')->put($dir.$name,  $realImg, 'public');
                \Storage::disk('public')->put($dir.'thumb-'.$name, $img, 'public');

                $items = [
                    'name' => $dir.$name,
                    'thumb' => $dir.'thumb-'.$name
                ];

                array_push($itemsName,$items);
            }
        }

        return $itemsName;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publicShow($id)
    {
        $priceOffer = null;

        $itemInfo = DB::table($this->table)
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_026', 'GR_029.CategoryID', '=', 'GR_026.CategoryID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->join('fashionrecovery.GR_035', 'GR_029.ClothingStyleID', '=', 'GR_035.ClothingStyleID')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_027', 'GR_029.TypeID', '=', 'GR_027.TypeID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    //->join('fashionrecovery.GR_031', 'GR_029.OffSaleID', '=', 'GR_031.OfferID')
                    ->where('GR_029.ItemID',$id)
                    ->select('GR_029.ItemID',
                             'GR_029.OffSaleID',
                             'GR_029.ItemDescription',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_029.SizeID',
                             'GR_018.ColorName',
                             'GR_025.DepName',
                             'GR_026.CategoryName',
                             'GR_017.BrandName',
                             'GR_019.ClothingTypeName',
                             'GR_027.TypeName',
                             'GR_001.Alias',
                             'GR_035.ClothingStyleName',
                             'GR_020.SizeName'
                         )
                    ->get()->first();

        $items = DB::table('fashionrecovery.GR_032')
                    ->where('ItemID',$id)
                    ->get();

        if(isset($itemInfo->OffSaleID)) {
            $offer = DB::table('fashionrecovery.GR_031')
                        ->where('OfferID',$itemInfo->OffSaleID)
                        ->first();

            $discount = $offer->Discount;

            $priceOffer = $itemInfo->ActualPrice - ($itemInfo->ActualPrice * ($offer->Discount / 100));
        }

        return view('item.public-show',compact(
            'ValidFrom',
            'ValidUntil',
            'priceOffer',
            'brands',
            'itemInfo',
            'discount',
            'items',
            'offers',
            'colors',
            'styles',
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $db = 'fashionrecovery';
        $ValidFrom = '';
        $ValidUntil = '';

        $item = DB::table($this->table) //Mostrar solo una imagen
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->where('GR_029.ItemID',$id)
                    ->select('GR_029.ItemID',
                             'GR_032.ItemPictureID',
                             'GR_032.ThumbPath',
                             'GR_029.OffSaleID',
                             'GR_029.BrandID',
                             'GR_029.ItemDescription',
                             //'GR_031.Discount',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_029.SizeID',
                             'GR_029.ColorID',
                             'GR_029.ClothingTypeID',
                             'GR_029.DepartmentID',
                             'GR_029.CategoryID',
                             'GR_029.ClothingStyleID',
                             'GR_029.TypeID',
                             'GR_029.ClosetID'
                         )
                    ->get()->groupBy('ItemID')->first();


        $colors        = DB::table('fashionrecovery.GR_018')
                            ->where('Active',1)->get();

        $departments   = DB::table('fashionrecovery.GR_025')
                            ->where('Active',1)->get();

        $categories    = DB::table('fashionrecovery.GR_026')
                            ->where('Active',1)->get();

        $styles        = DB::table('fashionrecovery.GR_035')
                            ->where('Active',1)->get();

        $types         = DB::table('fashionrecovery.GR_027')
                            ->where('Active',1)->get();

        $brands        = DB::table('fashionrecovery.GR_017')
                            ->where('Active',1)
                            ->where('DepartmentID',$item->first()->DepartmentID)
                            ->get();

        $clothingTypes = DB::table('fashionrecovery.GR_019')
                            ->where('Active',1)
                            ->where('DepartmentID',$item->first()->DepartmentID)
                            ->where('BrandID',$item->first()->BrandID)
                            ->where('CategoryID',$item->first()->CategoryID)
                            ->get();

        $sizes         = DB::table('fashionrecovery.GR_020')
                            ->where('Active',1)
                            ->where('DepartmentID',$item->first()->DepartmentID)
                            ->where('BrandID',$item->first()->BrandID)
                            ->where('ClothingTypeID',$item->first()->ClothingTypeID)
                            ->get();

        $closets       = DB::table('fashionrecovery.GR_030')
                            ->where('UserID',Auth::User()->id)
                            ->get();

        $offers = DB::table('fashionrecovery.GR_031')
                    ->where('UserID',Auth::User()->id)
                    ->get()
                    ->groupBy('OfferID')->toArray();

        if(isset($item->first()->OffSaleID)) {

            $offer = $offers[$item->first()->OffSaleID];

            $ValidFrom = date("d/m/Y", strtotime($offer[0]->ValidFrom));
            $ValidUntil = date("d/m/Y", strtotime($offer[0]->ValidUntil));
        }

        return view('item.show',compact(
            'ValidFrom',
            'ValidUntil',
            'brands',
            'item',
            'offers',
            'colors',
            'styles',
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item          = DB::table($this->table)->where('ItemID',$id)->first();
        $colors        = DB::table('fashionrecovery.GR_018')->where('Active',1)->get();
        $sizes         = DB::table('fashionrecovery.GR_020')->where('Active',1)->get();
        $clothingTypes = DB::table('fashionrecovery.GR_019')->where('Active',1)->get();
        $departments   = DB::table('fashionrecovery.GR_025')->where('Active',1)->get();
        $categories    = DB::table('fashionrecovery.GR_026')->where('Active',1)->get();
        $styles        = DB::table('fashionrecovery.GR_026')->where('Active',1)->get();
        $types         = DB::table('fashionrecovery.GR_027')->where('Active',1)->get();
        $closets       = DB::table('fashionrecovery.GR_030')->get();
        $offers        = DB::table('fashionrecovery.GR_031')->get();

        return view('item.edit',compact(
            'item',
            'colors',
            'sizes',
            'clothingTypes',
            'departments',
            'categories',
            'styles',
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

            $data = $this->updateItemData($request->toArray());

            DB::table($this->table)->where('ItemID',$id)->update($data);

            // $itemsName = $this->saveItems($request->toArray(), $id);

            // DB::delete('DELETE FROM fashionrecovery."GR_032" WHERE "ItemID"='.$id);

            // foreach ($itemsName as $key => $value) { //change
            //      DB::table('fashionrecovery.GR_032')->insert([
            //          'ItemID' => $id,
            //          'PicturePath' => $value,
            //          'CreationDate' => date("Y-m-d H:i:s")
            //      ]);
            // }

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('item/'.$id); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('item/'.$id);
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

            Session::flash('success','Se ha eliminado correctamente la prenda.');
            return Redirect::to('items');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('item/'.$id);
        }
    }

    public function addItem(Request $request, $itemId) {

        DB::beginTransaction();

        try {

            $itemsName = $this->saveItems($request->toArray(), $itemId);

            foreach ($itemsName as $key => $value) { //change

                 DB::table('fashionrecovery.GR_032')->insert([
                    'ItemID' => $itemId,
                    'PicturePath' => $value['name'],
                    'ThumbPath' => $value['thumb'],
                    'CreationDate' => date("Y-m-d H:i:s")
                 ]);
            }

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('item/'.$itemId);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('item/'.$itemId);
        }
    }
}
