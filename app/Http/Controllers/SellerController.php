<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Image;
use File;

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

            $this->saveID($request->toArray());
            $selfie = $this->saveSelfie($request->toArray(), false);

            $data = $this->sellerData($request->toArray(), $selfie);

            DB::table($this->table)->insert($data);

            DB::table('fashionrecovery.GR_001')
                ->where('id',Auth::User()->id)
                ->update(['ProfileID' => 2]);



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


            $this->saveID($request->toArray());
            $selfie = $this->saveSelfie($request->toArray());

            $data = $this->sellerData($request->toArray(), $selfie);

            DB::table($this->table)
                ->where('SellerID',$id)
                ->update($data);

            

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
    protected function saveSelfie($data, $isUpdate) {

        $date         = date("Ymd-His");
        $dir          = "sellers/".Auth::User()->id.'/';
        $selfieName   = $date.'_'.Auth::User()->id.'_selfie.jpg';
        $img          = Image::make($data['SelfiePath']->getRealPath())->fit(200);
        $img->stream();

        if($isUpdate) {

            $seller = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->first();

            File::delete($seller->SelfiePath, $seller->SelfieThumbPath);
        }

        \Storage::disk('public')->put($dir.$selfieName,  \File::get($data['SelfiePath']));
        \Storage::disk('public')->put($dir.'thumb-'.$selfieName, $img, 'public');

        return [
                'mean'  => 'storage/'.$dir.$selfieName,
                'thumb' => 'storage/'.$dir.'thumb-'.$selfieName
            ];
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

    protected function sellerData($data, $selfie) {

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
             'SelfiePath'           => $selfie['mean'],
             'SelfieThumbPath'      => $selfie['thumb'],
             'VerifiedEmail'        => false,
             'VerifiedPhone'        => false //Phone ?
        ];
    }

    public function updateSelfie(Request $request, $id) {

        DB::beginTransaction();

        try {
        
            $selfie = $this->saveSelfie($request->toArray(), true);
            
            DB::table($this->table)
                ->where('UserID',$id)
                ->update([
                    'SelfiePath' => $selfie['mean'],
                    'SelfieThumbPath' => $selfie['thumb'],
                ]);


            DB::commit();

            Session::flash('success','Se ha actualizado la foto de perfil exitosamente.');
            return Redirect::to('auth/'.$id);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente.');
            return Redirect::to('auth/'.$id);
        }
    }

}
