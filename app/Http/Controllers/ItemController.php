<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;


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
        //
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
        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->itemData($request->toArray());

            DB::table($this->table)->insert($data);

            $this->saveItems($request->toArray());

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('item'); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('seller');
        }
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        $request->validate([
            'PicturesUploaded' => ['required'], //validar imagenes
            'OriginalPrice'    => ['required'],
            'ActualPrice'      => ['required'],
            'ColorID'          => ['required'],
            'SizeID'           => ['required'],
            'ClothingTypeID'   => ['required'],
            'DepartmentID'     => ['required'],
            'CategoryID'       => ['required'],
            'TypeID'           => ['required'],
            'ClosetID'         => ['required'],
            'OffSaleID'        => ['required']
        ]);
    }

    protected function itemData($data) {

        $closet = $data['ClosetID'] == "default" ?
                    $this->saveDefaultCloset()->ClosetID :
                    $data['ClosetID'];

        return [
             'OwnerID'          => Auth::User()->id,
             'PicturesUploaded' => true, //path $data['PicturesUploaded']
             'OriginalPrice'    => $data['OriginalPrice'],
             'ActualPrice'      => $data['ActualPrice'],
             'ColorID'          => 1,
             'SizeID'           => 1,
             'ClothingTypeID'   => $data['ClothingTypeID'],
             'DepartmentID'     => $data['DepartmentID'],
             'CategoryID'       => $data['CategoryID'],
             'TypeID'           => $data['TypeID'],
             'ClosetID'         => $closet,
             'OffSaleID'        => 1,
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
    protected function saveItems($data) {

        foreach ($data['PicturesUploaded'] as $key => $value) {
            $date   = date("Y-m-d H:i:s");
            $itemName = "items/".Auth::User()->id.'_ID.jpg'; //nombre de la imagen

            \Storage::disk('public')->put($itemName,  \File::get($value));
        }

        return true;
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
}
