<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;

class SellerController extends Controller
{

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

            DB::table('fashionrecovery.GR_033')->insert($data);

            DB::commit();

            Session::flash('success','Se ha registrado correctamente');
            return Redirect::to('register/seller');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('register/seller');
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


    /* Save ID document to disk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function saveID($data) {

        $date         = date("Y-m-d H:i:s");
        $originalName = $data['IdentityDocumentPath']->getClientOriginalName();
        $ext          = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $IDName       = "sellers/".Auth::User()->id.'/'.Auth::User()->id.'_ID.'.$ext;

        \Storage::disk('public')->put($IDName,  \File::get($data['IdentityDocumentPath']));

        return $IDName;
    }

    /* Save ID document to disk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function saveSelfie($data) {

        $date         = date("Y-m-d H:i:s");
        $originalName = $data['SelfiePath']->getClientOriginalName();
        $ext          = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $selfieName   = "sellers/".Auth::User()->id.'/'.Auth::User()->id.'_selfie.'.$ext;

        \Storage::disk('public')->put($selfieName,  \File::get($data['SelfiePath']));

        return $selfieName;
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
            'Greeting'             => ['required','max:50'],
            'AboutMe'              => ['required','max:256'],
            'LiveIn'               => ['required','max:35'],
            'WorkIn'               => ['required','max:35'],
            'IdentityDocumentPath' => ['required','mimes:jpg,jpeg,png'],
            'SelfiePath'           => ['required','mimes:jpg,jpeg,png']
        ]);
    }

    protected function sellerData($data) {

        return [
             'UserID'               => Auth::User()->id,
             'SellerSince'          => date("Y-m-d H:i:s"),
             'Greeting'             => $data['Greeting'],
             'AboutMe'              => $data['AboutMe'],
             'LiveIn'               => $data['LiveIn'],
             'WorkIn'               => $data['WorkIn'],
             'TotalEvaluations'     => 0,
             'ItemsSold'            => 0,
             'ItemsReturned'        => 0,
             'Ranking'              => 0,
             'VerifiedByFR'         => false,
             'Ranking'              => 0,
             'IdentityDocument'     => isset($data['IdentityDocumentPath']) ? true : false,
             'IdentityDocumentPath' => $this->saveID($data),
             'Selfie'               => isset($data['SelfiePath']) ? true : false,
             'SelfiePath'           => $this->saveSelfie($data),
             'VerifiedEmail'        => false,
             'VerifiedPhone'        => false //Phone ?
        ];
    }

}
