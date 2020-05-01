<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;
use Image;
use File;
use Gate;

use App\States;
use App\User;

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
        if (Gate::denies('create-seller')) {
            abort(403);
        }

        $isNew = true;

        $states = States::get();

        return view('seller.create',compact('isNew','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-seller')) {
            abort(403);
        }

        $this->validator($request);

        DB::beginTransaction();

        try {

            $IDP    = $this->saveID($request->toArray(), true);
            $selfie = $this->saveSelfie($request->toArray(), false);

            $dataSeller = $this->sellerData($request->toArray(), $selfie, $IDP);

            $dataAddress = $this->addressData($request->toArray());

            DB::table($this->table)->insert($dataSeller);

            DB::table('fashionrecovery.GR_002')->insert($dataAddress);

            DB::table('fashionrecovery.GR_001')
                ->where('id',Auth::User()->id)
                ->update(['ProfileID' => 2]);

            DB::commit();
            //return response()->json('success', 200);

            return Redirect::to('welcome/seller');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error'.$ex);
            //return response()->json(null, $ex->getCode());
            return Redirect::to('seller');
        }
    }

    public function deleteSecret($id) {
        DB::table('fashionrecovery.GR_001')
                ->where('id',$id)
                ->update(['ProfileID' => 1]);

        DB::delete('DELETE FROM fashionrecovery."GR_033" WHERE "UserID"='.$id);

        DB::delete('DELETE FROM fashionrecovery."GR_002" WHERE "UserID"='.$id);

        dd('Eliminado');
    }

    public function sellerWelcome() {
        return view('seller.welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $isFollower = false;
        $seller = DB::table('fashionrecovery.GR_001')
                    ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')
                    ->where('GR_001.Alias',$alias)
                    ->where('GR_001.Confirmed',1)
                    ->where('GR_001.ProfileID',2)
                    ->select('GR_001.Alias','GR_001.Name','GR_001.Lastname','GR_033.Greeting','GR_033.AboutMe','GR_033.LiveIn','GR_033.WorkIn','GR_033.TotalEvaluations','GR_033.ItemsSold','GR_033.ItemsReturned','GR_033.Ranking','GR_033.SelfiePath','GR_033.SelfieThumbPath','GR_001.id','GR_033.SellerSince')
                    ->first();

        $closets = DB::table('fashionrecovery.GR_030')
                    ->where('UserID',$seller->id)
                    ->select('GR_030.ClosetID','GR_030.ClosetName','GR_030.CreationDate','GR_030.ClosetDescription')
                    ->get();

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->where('GR_032.IsCover',true)
                    ->where('GR_029.IsSold',false)
                    ->where('GR_029.IsPaused',false)
                    ->where('GR_029.OwnerID',$seller->id)
                    ->select('GR_032.ThumbPath','GR_029.ItemID')
                    ->get();

        if(isset(Auth::User()->id)) {

           $follower = DB::table('fashionrecovery.GR_038')
                        ->where('GR_038.UserID',Auth::User()->id)
                        ->where('GR_038.SellerID',$seller->id)
                        ->get(); 

            $isFollower = $follower->count() > 0 ? true : false;
        }

        $sellerSince = $this->formatDate("d F Y", $seller->SellerSince);

        return view('seller.show',compact('seller','closets','items','sellerSince','isFollower'));
    }

    protected function formatDate($format, $date) {

        $date    = date($format, strtotime($date));
        $explode = explode(" ", $date);
        $format = [];

        $months = [
                'January'   =>'enero',
                'February'  =>'febrero',
                'March'     =>'marzo',
                'April'     =>'abril',
                'May'       =>'Mayo',
                'June'      =>'junio',
                'July'      =>'julio',
                'August'    =>'agosto',
                'September' =>'septiembre',
                'October'   =>'octubre',
                'November'  =>'noviembre',
                'December'  =>'diciembre',
            ];

        return $explode[0].' de '.$months[$explode[1]].' '.$explode[2];
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);

        if(!$this->authorize('updateUser',  $user)) {
            abort(403);
        }

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
        $user = User::findOrfail($id);

        if(!$this->authorize('updateUser',  $user)) {
            abort(403);
        }

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
            return Redirect::back();
            return redirect()->action('AuthController@show', ['id' => $id]);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::back();
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

        ini_set('memory_limit', "2000M");

        if($data['id_item_file'] && !$isNew) {

            $seller = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->first();

            File::delete($seller->IdentityDocumentPath);
        }

        $realImg = Image::make($data['id_item_file']->getRealPath())
                                ->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                });
        $realImg->stream();

        \Storage::disk('public')->put($IDName, $realImg, 'public');

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
        ini_set('memory_limit', "2000M");
        $img          = Image::make($data['profile_item_file']->getRealPath())
                            ->orientate()->fit(200);
        $img->stream();

        if($isUpdate) {

            $seller = DB::table($this->table)
                        ->where('UserID',Auth::User()->id)
                        ->first();

            File::delete($seller->Selfie, $seller->SelfieThumbPath);
        }

        $realImg = Image::make($data['profile_item_file']->getRealPath())
                                ->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                });
        $realImg->stream();

        \Storage::disk('public')->put($dir.$selfieName, $realImg, 'public');
        \Storage::disk('public')->put($dir.'thumb-'.$selfieName, $img, 'public');

        return [
                'mean'  => 'storage/'.$dir.$selfieName,
                'thumb' => 'storage/'.$dir.'thumb-'.$selfieName
            ];
    }

    
    public function guardarropaStatus($Type, $IsPaused, $ItemID)
    {
        $urls = [
            'all'       => 'fashionrecovery.GR_001',
            'item'      => 'fashionrecovery.GR_029',
            'colection' => 'fashionrecovery.GR_030'
        ];
        
        $ids = [
            'all'       => 'id',
            'item'      => 'ItemID',
            'colection' => 'ClosetID'
        ];

        $id = $ids[$Type] === 'id' ? 
              Auth::User()->id : $ItemID ;

        $user = DB::table($urls[$Type])
                    ->where($ids[$Type],$id)
                    ->update([
                        'IsPaused' => $IsPaused
                    ]);
        
        return response()->json("success");
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
            'Phone'                => ['numeric','digits:10'],
            'LiveIn'               => ['max:100'],
            'id_item_file'         => ['mimes:jpg,jpeg,png'],
            'profile_item_file'    => ['mimes:jpg,jpeg,png'],

            'Alias'                => ['max:50'],
            'Street'               => ['max:50'],
            'Suburb'               => ['max:50'],
            'ZipCode'              => ['regex:/^\d{5}$|^\d{5}-\d{4}$/'],
            'Ext'                  => ['max:50'],
            'Int'                  => ['max:50'],
            'State'                => ['max:50'],
            'City'                 => ['max:25'],
            'PhoneContact'         => ['numeric','digits:10'],
            'References'           => ['max:100']
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
             'VerifiedPhone'        => false, //Phone ?
        ];
    }

    public function addressData($data) {
        
        return [           
            'UserID'               => Auth::User()->id,
            'Alias'                => $data['Alias'],
            'Street'               => $data['Street'],
            'Suburb'               => $data['Suburb'],
            'ZipCode'              => $data['ZipCode'],
            'State'                => $data['State'],
            'City'                 => $data['City'],
            'Ext'                  => $data['Ext'],
            'Int'                  => $data['Int'],
            'PhoneContact'         => $data['PhoneContact'],
            'References'           => $data['References'],
            'CreationDate'         => date("Y-m-d H:i:s"),
            'Active'               => true, //
            'IsDefault'            => true, //
        ];
    }

    public function updateSelfie(Request $request, $id) {

        $user = User::findOrfail($id);

        if(!$this->authorize('updateUser',  $user)) {
            abort(403);
        }
        
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
