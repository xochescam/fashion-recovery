<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ConfirmAccount;

use DB;
use Redirect;
use Session;
use Auth;
use Mail;
use Gate;

use App\User;
use App\States;
use App\Bank;

class AuthController extends Controller
{
    protected $table = 'fashionrecovery.GR_001';

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = Auth::User()->id;
        $user = User::findOrfail($id);
        $states    = States::get();

        if(!$this->authorize('viewUser',  $user)) {
            abort(403);
        }

        $user             = Auth::User();
        $seller           = null;
        $invoice          = null;
        $shipping         = null;
        $bank             = null;
        $sellerSince      = '';
        $items            = 0;
        $type_url         = 'auth';
        $banks            = Bank::all();
        $creationDateUser = $this->formatDate("d F Y", $user->CreationDate);
        $birthMonth       = $user->Birthdate ? date("m", strtotime($user->Birthdate)) : null;
        $birthDay         = $user->Birthdate ? date("d", strtotime($user->Birthdate)) : null;
        $birthYear        = $user->Birthdate ? date("Y", strtotime($user->Birthdate)) : null;

        if($user->ProfileID == 2) {

            $items = DB::table('fashionrecovery.GR_029')
                        ->where('OwnerID',$user->id)
                        ->count();

            $seller = DB::table('fashionrecovery.GR_033')
                        ->where('UserID',$id)
                        ->first();

            $sellerSince = $this->formatDate("d F Y", $seller->SellerSince);

            $invoice = DB::table('fashionrecovery.GR_003')
                        ->where('UserID',$id)
                        ->first();

            $bank = DB::table('fashionrecovery.GR_053')
                        ->where('UserID',$id)
                        ->first();

            $shipping = DB::table('fashionrecovery.GR_002')
                        ->where('UserID',$id)
                        ->get();

        } else if($user->ProfileID == 1) {

            $invoice = DB::table('fashionrecovery.GR_003')
                        ->where('UserID',$id)
                        ->first();

            $shipping = DB::table('fashionrecovery.GR_002')
                        ->where('UserID',$id)
                        ->get();
        }

        $isPayment = count($shipping) == 0 ? false : true;

        return view('auth.show',
            compact('birthMonth',
                    'birthDay',
                    'birthYear',
                    'isPayment',
                    'seller',
                    'type_url',
                    'creationDateUser',
                    'birthDateUser',
                    'sellerSince',
                    'items',
                    'invoice',
                    'shipping',
                    'states',
                    'bank',
                    'banks'));
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

        $auth = DB::table($this->table)
                    ->where('id',$id)
                    ->first();

        return view('auth.edit',compact('auth'));
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

        $user = DB::table($this->table)
                ->where('id',$id)
                ->get(['Birthdate','Gender'])->first();

        $birthDate = $user->Birthdate;
        $gender    = $user->Gender;

        if($birthDate != null && !isset($request->birth_date)) {

            Session::flash('warning','Selecciona tu fecha de nacimiento.');
            return Redirect::to('account');

        } else if($gender != null && !isset($request->gender)) {

            Session::flash('warning','Selecciona tu g??nero.');
            return Redirect::to('account');
        }

        DB::beginTransaction();

        try {

            $data = $this->authData($request->toArray(), $user);

            DB::table($this->table)
                ->where('id',$id)
                ->update($data);

            DB::commit();

            Session::flash('success','Se han actualizado los datos correctamente.');
            return Redirect::to('account');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, int??ntalo nuevamente');
            return Redirect::to('account');
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
        //unique:users,email,'.$id
        $request->validate([
            'name'       => isset($request->name) ? ['max:80'] : [''],
            'last_name'  => isset($request->last_name) ? ['max:80'] : [''],
            'email'      => ['email', 'max:100'],
            'password'   => ['confirmed','min:6'],
            'Alias'      => ['max:30'],
        ]);
    }

    protected function authData($data, $user) {

        // $date = $user->Birthdate;

        // if(isset($data['birth_date'])) {

        //     $item = str_replace('/', '-', $data['birth_date']);
        //     $date = date("Y-m-d", strtotime($item));
        // }

        $date = $user->Birthdate;

        if(isset($data['birth_date'])) {

            $date = $data['birth_date'][2].'-'.
                    $data['birth_date'][1].'-'.
                    $data['birth_date'][0];
        }

        $gender = isset($data['gender']) ? $data['gender']: $user->Gender;

        return [
             'email'         => $data['email'],
             'Alias'         => $data['Alias'],
             'Name'          => $data['Name'],
             'Lastname'      => $data['last_name'],
             'Notifications' => isset($data['notifications']) ? true : false,
             'Gender'        => $gender == Null ? Null : $gender,
             'Birthdate'     => $date == Null ? Null : $date
        ];
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

    public function resend($userID) {
        $table = 'fashionrecovery.GR_001';
        $user  = DB::table($table)->where('id',$userID)->first();

        if($user->Confirmed) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            Mail::to($user->email)
                ->send(new ConfirmAccount($user, 0));

            DB::commit();

            Session::flash('success','Se ha reenviado el correo exitosamente.');
            return Redirect::to('dashboard');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, int??ntalo nuevamente.');
            return Redirect::to('dashboard');
        }
    }

    public function confirmAccount($userId, $beSeller) {

        $table = 'fashionrecovery.GR_001';
        $user  = DB::table($table)->where('id',$userId)->first();

        if($user->Confirmed) {
            Session::flash('warning','La cuenta ya ha sido confirmada. Puedes iniciar sesi??n.');
            return Redirect::to('login/'.$beSeller);
        }

        DB::beginTransaction();

        try {

            DB::table($table)
                ->where('id',$userId)
                ->update(['Confirmed' => true]);

            DB::commit();

            Session::flash('success','Se ha confirmado la cuenta exitosamente');
            return Redirect::to('login/'.$beSeller);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, int??ntalo nuevamente');
            return Redirect::to('login/'.$beSeller);
        }
    }


}
