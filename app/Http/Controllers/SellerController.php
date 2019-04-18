<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Image;

class SellerController extends Controller
{
    protected $table = 'fashionrecovery.GR_033';

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
        if(!Auth::User()->isBuyerProfile()) {
            abort(403);
        }

        return view('seller.create');
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

            $data = $this->sellerData($request->toArray());

            DB::table($this->table)->insert($data);

            DB::table('fashionrecovery.GR_001')
                ->where('id',Auth::User()->id)
                ->update(['ProfileID' => 2]);

            $this->saveID($request->toArray());
            $this->saveSelfie($request->toArray());

            DB::commit();

            Session::flash('success','Se ha registrado correctamente');
            return Redirect::to('item'); //cambiar

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error');
            return Redirect::to('seller');
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
        $seller = DB::table($this->table)
                    ->where('SellerID',$id)
                    ->first();

        return view('seller.edit',compact('seller'));
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
        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->sellerData($request->toArray());

            DB::table($this->table)
                ->where('SellerID',$id)
                ->update($data);

            $this->saveID($request->toArray());
            $this->saveSelfie($request->toArray());

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('seller/'.$id.'/edit');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('seller/'.$id.'/edit');
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
        //
    }


    /* Save ID document to disk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function saveID($data) {
        $date         = date("Y-m-d H:i:s");
        $IDName       = "sellers/".Auth::User()->id.'/'.Auth::User()->id.'_ID.jpg';

        \Storage::disk('public')->put($IDName,  \File::get($data['IdentityDocumentPath']));

        return true;
    }

    /* Save ID document to disk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function saveSelfie($data) {

        $date         = date("Y-m-d H:i:s");
        $dir          = "sellers/".Auth::User()->id.'/';
        $selfieName   = Auth::User()->id.'_selfie.jpg';
        $img          = Image::make($data['SelfiePath']->getRealPath())->fit(200);
        $img->stream();

        \Storage::disk('public')->put($dir.$selfieName,  \File::get($data['SelfiePath']));
        \Storage::disk('public')->put($dir.'thumb-'.$selfieName, $img, 'public');

        return true;
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
            'Greeting'             => ['max:50'],
            'AboutMe'              => ['max:256'],
            'Phone'                => ['numeric'],
            'LiveIn'               => ['max:35'],
            'WorkIn'               => ['max:35'],
            'IdentityDocumentPath' => ['mimes:jpg,jpeg,png'],
            //'SelfiePath'           => ['mimes:jpg,jpeg,png']
        ]);
    }

    protected function sellerData($data) {

        $userId = Auth::User()->id;

        return [
             'UserID'               => $userId,
             'SellerSince'          => date("Y-m-d H:i:s"),
             'Greeting'             => $data['Greeting'],
             'AboutMe'              => $data['AboutMe'],
             'LiveIn'               => $data['LiveIn'],
             'WorkIn'               => null,
             'Phone'                => $data['Phone'],
             'TotalEvaluations'     => 0,
             'ItemsSold'            => 0,
             'ItemsReturned'        => 0,
             'Ranking'              => 0,
             'VerifiedByFR'         => false,
             'Ranking'              => 0,
             'IdentityDocument'     => isset($data['IdentityDocumentPath']) ? true : false,
             'IdentityDocumentPath' => 'storage/sellers/'. $userId.'/'.$userId.'_ID.jpg',
             'Selfie'               => isset($data['SelfiePath']) ? true : false,
             'SelfiePath'           => 'storage/sellers/'. $userId.'/'.$userId.'_selfie.jpg',
             'SelfieThumbPath'      => 'storage/sellers/'. $userId.'/thumb-'.$userId.'_selfie.jpg',
             'VerifiedEmail'        => false,
             'VerifiedPhone'        => false //Phone ?
        ];
    }

}
