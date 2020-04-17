<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;
use Gate;

class CalendarSaleController extends Controller
{
    protected $table = 'fashionrecovery.GR_015';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('show-category')) {
            abort(403);
        }

        $calendarSales = DB::table($this->table)
                            ->orderBy('Holiday')
                            ->get();

        return view('catalogs.calendar-sale.list',compact('calendarSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-category')) {
            abort(403);
        }

        return view('catalogs.calendar-sale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-category')) {
            abort(403);
        }
        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)->insert($data);

            DB::commit();

            Session::flash('success','Se ha guardado correctamente');
            return Redirect::to('calendar-sales');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('calendar-sales/create');
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
        if (Gate::denies('update-category')) {
            abort(403);
        }

        $calendarSale = DB::table($this->table)
                            ->where('CalendarSalesID',$id)
                            ->first();

        return view('catalogs.calendar-sale.edit',compact('calendarSale'));
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
        if (Gate::denies('update-category')) {
            abort(403);
        }

        $this->validator($request);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray());

            DB::table($this->table)
                ->where('CalendarSalesID',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se ha modificado correctamente');
            return Redirect::to('calendar-sales');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('calendar-sales/'.$id.'/edit');
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
        if (Gate::denies('delete-category')) {
            abort(403);
        }
        
        DB::beginTransaction();

        try {

            $explode     = explode('.', $this->table);
            $stringTable = $explode[0].'."'.$explode[1].'"';

            DB::delete('DELETE FROM '.$stringTable.' WHERE "CalendarSalesID"='.$id);

            Session::flash('success','Se ha eliminado correctamente el registro');

            DB::commit();

            return Redirect::to('calendar-sales');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');

            return Redirect::to('calendar-sales');
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
            'holiday'     => ['required'],
            'periodStart' => ['required'],
            'periodEnd'   => ['required'],
            'discount'    => ['required'],
        ]);
    }


    public function getData($data) {

        return [
             'Holiday'      => $data['holiday'],
             'PeriodStart'  => $data['periodStart'],
             'PeriodEnd'    => $data['periodEnd'],
             'Discount'     => $data['discount'],
             'Active'       => isset($data['active']) ? true : false,
             'CreationDate' => date("Y-m-d H:i:s"),
             'CreatedBy'    => Auth::User()->id
        ];
    }
}
