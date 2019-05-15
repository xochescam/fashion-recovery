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

            $IDP    = $this->saveID($request->toArray(), true);
            $selfie = $this->saveSelfie($request->toArray(), false);

            $data = $this->sellerData($request->toArray(), $selfie, $IDP);

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

            $IDP = isset($request->id_item_file) ?
                    $this->saveID($request->toArray(), false) :
                    DB::table($this->table)
                        ->where('UserID',$id)
                        ->first()
                        ->IdentityDocumentPath;

            DB::table($this->table)
                ->where('UserID',$id)
                ->update([
                    'Greeting'             => $request->Greeting,
                    'AboutMe'              => $request->AboutMe,
                    'Phone'                => $request->Phone,
                    'LiveIn'               => $request->LiveIn,
                    'IdentityDocumentPath' => $IDP  
                ]);


            DB::commit();

            Session::flash('success','Se han modificado correctamente los datos del vendedor.');
            return Redirect::to('auth/'.$id);
            return redirect()->action('AuthController@show', ['id' => $id]);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('auth/'.$id);
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
    protected function saveID($data, $isNew) {
        $date         = date("Ymd-His");
        $IDName       = "sellers/".Auth::User()->id.'/'.$date.'_'.Auth::User()->id.'_ID.jpg';

        if($data['id_item_file'] && !$isNew) {

            $seller = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->first();

                        dd($seller);
            File::delete($seller->IdentityDocumentPath);
        }

        \Storage::disk('public')->put($IDName,  \File::get($data['id_item_file']));

        return 'storage/'.$IDName;
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
        $img          = Image::make($data['profile_item_file']->getRealPath())->fit(200);
        $img->stream();

        if($isUpdate) {

            $seller = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->first();

            File::delete($seller->Selfie, $seller->SelfieThumbPath);
        }

        \Storage::disk('public')->put($dir.$selfieName,  \File::get($data['profile_item_file']));
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
            //'WorkIn'               => ['max:35'],
            //'IdentityDocumentPath' => isset($request->id_item_file) ? ['mimes:jpg,jpeg,png'] : [''],
            //'SelfiePath'           => ['mimes:jpg,jpeg,png']
        ]);
    }

    protected function sellerData($data, $selfie, $IDP) {

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
             'IdentityDocument'     => isset($data['id_item_file']) ? true : false,
             'IdentityDocumentPath' => $IDP,
             'Selfie'               => isset($data['profile_item_file']) ? true : false,
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
