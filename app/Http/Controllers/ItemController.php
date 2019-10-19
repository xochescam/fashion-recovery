<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;

use App\Department;
use App\Category;
use App\ClothingType;
use App\Brand;
use App\Size;
use App\Color;
use App\Type;
use App\Offer;
use App\Closet;

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
        $allItems  = $this->getMyItems();
        $hasOffers = $this->getItemOffer($allItems);

        
        $items = $hasOffers->count() > 0 ? 
                 $hasOffers->merge($this->getItemWithoutOffer($allItems)) :
                 $this->getItemWithoutOffer($allItems);

        $thumbs = $this->getItemThumbs($items);
        
        $items = $items->map(function ($item, $key) use($thumbs) {

            $item->ThumbPath = $thumbs[$item->ItemID]->first()->ThumbPath;

            return $item;
        });
        

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

        $departments    = Department::getAll();
        $categories     = Category::getByDepartment();
        $clothingTypes  = ClothingType::getByCategory();
        $brands         = Brand::getByDepartment();
        $sizes          = Size::getByCategory();
        $colors         = Color::getAll(); 
        $types          = Type::getAll();
        $closets        = Closet::getByAuth();   
        
        return view('item.create',compact(
            'item',
            'departments',
            'categories',
            'clothingTypes',
            'sizes',
            'brands',
            'colors',
            'types',
            'offers',
            'closets'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $this->itemData($request->toArray());

            DB::table($this->table)->insert($data);

            $last = DB::table($this->table)
                    ->where('OwnerID',Auth::User()->id)
                    ->orderBy('CreationDate', 'desc')
                    ->first()
                    ->ItemID;

            $names = [
                'front'  => 0,
                'label'  => 1,
                'back'   => 2,
                'selfie' => 3,
                'in'     => 4,
                'extra'  => 5
            ];

            $types = [
                'front'  => 1,
                'label'  => 2,
                'back'   => 3,
                'selfie' => 4,
                'in'     => 5,
                'extra'  => 6
            ];

            $itemsName = $this->saveItems($request->toArray(), $last);

            foreach ($itemsName as $key => $value) { //change
                DB::table('fashionrecovery.GR_032')->insert([
                    'ItemID'       => $last,
                    'PicturePath'  => $value['name'],
                    'ThumbPath'    => $value['thumb'],
                    'TypeItemID'   => $types[$value['type']],
                    'IsCover'      => $names[$request->cover] === $key ? true : false,
                    'CreationDate' => date("Y-m-d H:i:s")
                ]);
            }

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('items'); //cambiar
 
      } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('item');
        } 
    }


    protected function updateItemData($data) {

        $data['ValidFrom'] = date("Y-m-d H:i:s",strtotime($data['ValidFrom']));
        $data['ValidUntil'] = date("Y-m-d H:i:s",strtotime($data['ValidUntil']));

        $closet = !isset($data['ClosetID']) || $data['ClosetID'] == "default" ?
                    $this->saveDefaultCloset()->ClosetID :
                    $data['ClosetID'];

        $OffSaleID = isset($data['offer']) ? $this->saveOffer($data) : null;
        $brand     = $this->getBrand($data['BrandID']);;

        return [
             'ItemDescription'  => $data['ItemDescription'],
             'OriginalPrice'    => $data['OriginalPrice'],
             'ActualPrice'      => $data['ActualPrice'],
             'ColorID'          => $data['ColorID'],
             'SizeID'           => $data['SizeID'],
             'ClothingTypeID'   => $data['ClothingTypeID'],
             'CategoryID'       => $data['CategoryID'],
             'TypeID'           => $data['TypeID'],
             'BrandID'          => $brand,
             'ClosetID'         => $closet,
             'OffSaleID'        => $OffSaleID,
        ];
    }

    protected function itemData($data) {

        $countImg = 0;
        $closet   = !isset($data['ClosetID']) || $data['ClosetID'] == "default" ?
                    $this->saveDefaultCloset()->ClosetID :
                    $data['ClosetID'];
        $OffSaleID = isset($data['offer']) ? $this->saveOffer($data) : null;
        $brand     = $this->getBrand($data['BrandID']);

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
             'TypeID'           => $data['TypeID'],
             'BrandID'          => $brand,
             'ClosetID'         => $closet,
             'OffSaleID'        => $OffSaleID,
             'OtherBrand'       => $data['BrandID'] == 'other' ? true : false,
             'CreationDate'     => date("Y-m-d H:i:s")
        ];
    }

    public function getBrand($BrandID) {
        $brand = DB::table('fashionrecovery.GR_017')
                    ->where('BrandName',$BrandID)
                    ->first();

        return isset($brand->BrandID) ? 
                $brand->BrandID : 
                $this->saveNewBrand($BrandID);
    }

    public function saveNewBrand($BrandID){

        DB::table('fashionrecovery.GR_017')->insert([
            'BrandName'    => $BrandID,
            'Active'       => true,
            'CreationDate' => date("Y-m-d H:i:s"),
            'CreatedBy'    => Auth::User()->id,
            'Verified'     => false
        ]);

        return DB::table('fashionrecovery.GR_017')
            ->where('CreatedBy',Auth::User()->id)
            ->orderBy('CreationDate', 'desc')
            ->first()
            ->BrandID;
    }

    public function saveClothingType($data) {

        DB::table('fashionrecovery.GR_019')
            ->insert([
                'ClothingTypeName' => $data['OtherClothingType'],
                'BrandID'          => $data['BrandID'],
                'DepartmentID'     => $data['DepartmentID'],
                'CategoryID'       => $data['CategoryID'],
                'Active'           => true,
                'CreationDate'     => date("Y-m-d H:i:s"),
                'CreatedBy'        => Auth::User()->id
            ]);

        $ClothingTypeID = DB::table('fashionrecovery.GR_019')
                    ->where('CreatedBy', Auth::User()->id)
                    ->get()->last()->ClothingTypeID;

        $SizeID = $this->saveSize($data, $ClothingTypeID);

        return [
            'SizeID'         => $SizeID,
            'ClothingTypeID' => $ClothingTypeID
        ];
    }

    public function saveSize($data, $ClothingTypeID) {

        DB::table('fashionrecovery.GR_020')
            ->insert([
                'SizeName'       => $data['OtherSize'],
                'ClothingTypeID' => $ClothingTypeID,
                'BrandID'        => $data['BrandID'],
                'DepartmentID'   => $data['DepartmentID'],
                'Active'         => true,
                'CreationDate'   => date("Y-m-d H:i:s"),
                'CreatedBy'      => Auth::User()->id
            ]);

         return DB::table('fashionrecovery.GR_020')
                    ->where('CreatedBy', Auth::User()->id)
                    ->get()->last()->SizeID;
    }

    public function saveOffer($data) {

        $remplaceValidFrom = str_replace('/', '-', $data['ValidFrom']);
        $ValidFrom = date("Y-m-d", strtotime($remplaceValidFrom));

        $remplaceValidUntil = str_replace('/', '-', $data['ValidUntil']);
        $ValidUntil = date("Y-m-d", strtotime($remplaceValidUntil));

        $userId = Auth::User()->id;

        $offer = DB::table('fashionrecovery.GR_031')
                    ->insert([
                        'Discount'   => $data['Discount'],
                        'ValidFrom'  => $ValidFrom,
                        'ValidUntil' => $ValidUntil,
                        'UserID'     =>  $userId
                    ]);

        return $id = DB::table('fashionrecovery.GR_031')
                        ->where('UserID', $userId)
                        ->get()->last()->OfferID;
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
        $count     = 0;

        foreach ($data as $key => $value) {

            $name = explode('_', $key);

            if(count($name) > 2 &&
                $name[1].'_'.$name[2] === "item_file") {

                $itemsName = $this->saveImg($value, $item, $count++, $itemsName, $name[0]);
            }
        }

        return $itemsName;
    }

    public function saveImg($value, $item, $count, $itemsName, $type) {

        $date   = date("Ymd-His");
        $dir = 'items/user_'.Auth::User()->id.'/item_'.$item.'/';
        $name = $date.'-'.$count.'.jpg';
        //ini_set('memory_limit', "2000M");

        $realImg = Image::make($value->getRealPath())
                        ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
        })->orientate();

        $realImg->stream();
        $img = Image::make($value->getRealPath())->orientate()->fit(300, 300);
        $img->stream();
        //ini_set('memory_limit', "256M");
        //eliminar carpeta al actualizar
        \Storage::disk('public')->put($dir.$name,  $realImg, 'public');
        \Storage::disk('public')->put($dir.'thumb-'.$name, $img, 'public');

        $items = [
            'name'  => $dir.$name,
            'thumb' => $dir.'thumb-'.$name,
            'type'  => $type
        ];

        array_push($itemsName,$items);

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
        $priceOffer   = null;
        $clothingType = null;
        $size         = null;
        $brand        = null;
        $otherBrand   = null;
        $wishlists    = null;
        $discount     = null;

        if(Auth::User()) {
            $wishlists = DB::table('fashionrecovery.GR_024')
                            ->where('UserID',Auth::User()->id)
                            ->get();
        }

        $info = DB::table($this->table)
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_026', 'GR_029.CategoryID', '=', 'GR_026.CategoryID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_027', 'GR_029.TypeID', '=', 'GR_027.TypeID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->where('GR_029.ItemID',$id)
                    ->select('GR_029.ItemID',
                             'GR_029.OffSaleID',
                             'GR_029.ItemDescription',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_018.ColorName',
                             'GR_025.DepName',
                             'GR_026.CategoryName',
                             'GR_019.ClothingTypeName',
                             'GR_017.BrandName',
                             'GR_017.BrandID',
                             'GR_027.TypeName',
                             'GR_001.Alias',
                             'GR_020.SizeName',
                             'GR_029.OtherBrand'
                         )->first(); 

        $items = DB::table('fashionrecovery.GR_032')
                    ->where('ItemID',$id)
                    ->get();

        if(isset($info->OffSaleID)) {
            $offer = DB::table('fashionrecovery.GR_031')
                        ->where('OfferID',$info->OffSaleID)
                        ->first();

            $discount = $offer->Discount;
            $price    = floatval(ltrim($info->ActualPrice,'$'));

            $priceOffer = $price - ($price  * ($offer->Discount / 100));
        }

        $questions = $this->getQuestions($id);

        return view('item.public-show',compact(
            'questions',
            'id',
            'wishlists',
            'ValidFrom',
            'ValidUntil',
            'priceOffer',
            'brands',
            'info',
            'discount',
            'items',
            'offers',
            'colors',
            'sizes',
            'clothingTypes',
            'departments',
            'categories',
            'types',
            'closets',
            'offers',
            'size',
            'brand',
            'clothingType',
            'otherBrand'
        ));
    }

    public function getQuestions($ItemID) {

        $all = DB::table( 'fashionrecovery.GR_039')
                        ->join('fashionrecovery.GR_001', 'GR_039.UserID', '=', 'GR_001.id')
                        ->where('GR_039.ItemID',$ItemID)
                        ->select('GR_039.*','GR_001.Name','GR_001.ProfileID','GR_001.Alias')
                        ->get();

        $addDate = $all->map(function ($item, $key) {

            $item->date = $this->getDate($item->CreationDate);

            return $item;
        });

        $parents = $addDate->where('IsParent',true);
        $sons    = $addDate->where('IsParent',false)->sortBy('CreationDate')->groupBy('ParentID');

        $questions = $parents->map(function ($item, $key) use($sons) {

            $item->answers = isset($sons[$item->QuestionID]) ?
                             $sons[$item->QuestionID] :
                             [];

            $item->filterAnsw = $item->answers !== [] ?
                            $item->answers->filter(function ($value, $key) {
                return $key > 0;
            }) : [];

            return $item;

        })->sortByDesc('CreationDate');

        return $questions;
    }

    public function getDate($date) {
        $year  = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day   = date('j', strtotime($date));

        return $day.'/'.$month.'/'.$year;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ValidFrom     = '';
        $ValidUntil    = '';
        $priceOffer    = Null;

        $item = DB::table($this->table) //Mostrar solo una imagen
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->where('GR_029.ItemID',$id)
                    ->first();
        
        $images = DB::table('fashionrecovery.GR_032')
                    ->where('GR_032.ItemID',$id)
                    ->get();

        $departments    = Department::getAll();
        $categories     = Category::getByDepartment();
        $clothingTypes  = ClothingType::getByCategory();
        $brands         = Brand::getByDepartment();
        $brand          = Brand::getBrand($item);
        $sizes          = Size::getByCategory();
        $colors         = Color::getAll(); 
        $types          = Type::getAll();
        $closets        = Closet::getByAuth(); 
        $offers         = isset($item->OffSaleID) ? Offer::getByAuth() : Null;   
        
        if(isset($offers)) {

            $offer = $offers[$item->OffSaleID];

            $ValidFrom = date("d/m/Y", strtotime($offer[0]->ValidFrom));
            $ValidUntil = date("d/m/Y", strtotime($offer[0]->ValidUntil));
            $ActualPrice   = ltrim($item->ActualPrice, '$');

            $priceOffer = $ActualPrice - ($ActualPrice * ($offer[0]->Discount / 100));
        }

        $departments = $departments->map(function ($department) use ($item){
            $isSelected = $item->DepartmentID === $department->value;
            $department->selected = $isSelected;
            return $department;
        });

        
        return view('item.edit',compact(
            'priceOffer',
            'ValidFrom',
            'ValidUntil',
            'brands',
            'item',
            'images',
            'offers',
            'colors',
            'sizes',
            'clothingTypes',
            'departments',
            'categories',
            'types',
            'closets',
            'brand'
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

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('item/'.$id.'/edit'); //cambiar

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
    public function destroy($id, $itemId)
    {
       DB::beginTransaction();

        try {

            $explode     = explode('.', $this->table);
            $stringTable = $explode[0].'."'.$explode[1].'"';

            DB::delete('DELETE FROM fashionrecovery."GR_032" WHERE "ItemPictureID"='.$id); //Eliminar de la carpeta, no dejar de eliminar todas las imagenes y tomar en cuenta las imagenes de portada

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente la imagen.');
            return Redirect::to('item/'.$itemId.'/edit');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('item/'.$itemId.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fullDestroy($id)
    {
       DB::beginTransaction();

        try {

            DB::delete('DELETE FROM fashionrecovery."GR_032" WHERE "ItemID"='.$id);
            DB::delete('DELETE FROM fashionrecovery."GR_029" WHERE "ItemID"='.$id);

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

            $realFiles = explode(',', $request->add_item_file);
            $itemsName = [];
            $count = 0;

            foreach ($request->PicturesUploaded as $key => $value) {

                if(in_array($value->getClientOriginalName(), $realFiles)) {

                    $itemsName = $this->saveNewItems($itemsName, $count, $value, $itemId);

                }

            }

            foreach ($itemsName as $key => $value) { //change

                 DB::table('fashionrecovery.GR_032')->insert([
                    'ItemID'      => $itemId,
                    'PicturePath' => $value['name'],
                    'IsCover'       => false,
                    'ThumbPath'   => $value['thumb'],
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

    public function saveNewItems($itemsName, $count, $value, $itemId) {
        $date   = date("Ymd-His");
        $dir = 'items/user_'.Auth::User()->id.'/item_'.$itemId.'/';
        $name = $date.'-'.$count++.'.jpg';
        //ini_set('memory_limit', "2000M");


        $realImg = Image::make($value->getRealPath())
                        ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
        })->orientate();

        $realImg->stream();
        $img = Image::make($value->getRealPath())->orientate()->fit(200);
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

        return $itemsName;
    }

    public function getMyItems() {

        $items = DB::table('fashionrecovery.GR_029')
                    //->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    //->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->select('GR_029.ItemID','GR_029.OffSaleID','GR_029.CreationDate','GR_029.ItemDescription','GR_029.OriginalPrice','GR_029.ActualPrice','GR_018.ColorName','GR_029.BrandID','GR_029.SizeID')
                    ->get();

        return $items->map(function ($item, $key) {

            $size       = '';
            $brand      = '';
            $otherBrand = '';

           if(isset($item->BrandID)) {

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

    public function getItemThumbs($all) {

        return DB::table('fashionrecovery.GR_032')
                    ->whereIn('ItemID',$all->groupBy('ItemID')->keys())
                    ->where('IsCover',true)
                    ->get()
                    ->groupBy('ItemID');
    }
}
