<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use Session;
use Auth;


class ClosetController extends Controller
{
    protected $table = 'fashionrecovery.GR_030';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $closets = DB::table($this->table) //Mostrar solo una imagen
                    ->where('UserID',Auth::User()->id)
                    ->get();


        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->whereIn('GR_029.ClosetID',$closets->groupBy('ClosetID')->keys()->toArray())
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->get()
                    ->groupBy('ClosetID')
                    ->toArray();

        return view('closet.list',compact('closets','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('closet.create');
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

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('closet');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('closet');
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
        $closet = DB::table($this->table)->where('ClosetID',$id)->first();

        $items = DB::table($this->table)
                    ->join('fashionrecovery.GR_029', 'GR_030.ClosetID', '=', 'GR_029.ClosetID')
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->join('fashionrecovery.GR_031', 'GR_029.OffSaleID', '=', 'GR_031.OfferID')
                    ->where('fashionrecovery.GR_030.ClosetID',$id)
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->select('GR_029.ItemID','GR_032.ItemPictureID','GR_032.PicturePath','GR_031.Discount','GR_029.OriginalPrice','GR_029.ActualPrice')
                    ->get()
                    ->groupBy('ItemID');

        return view('closet.show',compact('items','closet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $closet = DB::table($this->table)
                    ->where('ClosetID',$id)
                    ->first();

        return view('closet.edit',compact('closet'));
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

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('ClosetID',$id)
                ->update($data);

            Session::flash('success','Se ha modificado correctamente');

            DB::commit();

            return Redirect::to('closets/');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('closets');
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

            DB::delete('DELETE FROM '.$stringTable.' WHERE "ClosetID"='.$id);

            DB::commit();

            Session::flash('success','Se ha eliminado correctamente el registro');
            return Redirect::to('closets');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('closets');
        }
    }


    /**
     * Validate the brand request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validator($request)
    {
        return $request->validate([
            'ClosetName' => ['required']
        ]);
    }


    public function getData($data) {

        return [
            'UserID'       => Auth::User()->id,
            'ClosetName'   => $data['ClosetName'],
            'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
