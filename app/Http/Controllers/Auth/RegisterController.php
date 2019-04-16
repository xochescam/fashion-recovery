<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;

use App\Mail\ConfirmAccount;

use DB;
use Session;
use Redirect;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getForm($beSeller) {

        return view('auth.register',compact('beSeller'));
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
            'name'       => isset($request->name) ? ['max:80'] : [''],
            'last_name'  => isset($request->last_name) ? ['max:80'] : [''],
            'email'      => ['email', 'max:100'],
            'password'   => ['confirmed','min:6'],
            'alias'      => ['max:30'],
            'birth_date' => isset($request->birth_date) ? ['date','before:'.date("Y-m-d")] : [''],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $beSeller)
    {

        $this->validator($request);

        if($this->existsEmail($request->email)) {

            Session::flash('warning','Esta cuenta ya existe. Accede a tu cuenta');
            return Redirect::to('register/'.$beSeller);
        }

        DB::beginTransaction();

        try {

            event(new Registered($user = $this->create($request->all())));

            $user = DB::table('fashionrecovery.GR_001')
                        ->where('email',$request->email)
                        ->first();

            Mail::to($user->email)
                ->send(new ConfirmAccount($user, $beSeller));

            DB::commit();

            Session::flash('success','Se ha registrado correctamente');
            return $this->registered($request, $user)
                            ?: redirect('login/'.$beSeller);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('register/'.$beSeller);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return DB::table('fashionrecovery.GR_001')->insert([
             'email'         => $data['email'],
             'password'      => Hash::make($data['password']),
             'Alias'         => $data['alias'],
             'Name'          => $data['name'],
             'Lastname'      => $data['last_name'],
             'Gender'        => $data['gender'],
             'Birthdate'     => $data['birth_date'],
             'ProfileID'     => 1,
             'StatusID'      => 1,
             'CreatedFromID' => 3,
             'CreationDate'  => date("Y-m-d H:i:s"),
             'Confirmed'     => false,
             'Notifications' => isset($data['notifications']) ? true : false
        ]);
    }

    protected function existsEmail($email) {

        $user = DB::table('fashionrecovery.GR_001')
                  ->where('email',$email)
                  ->first();

        return $user === null ? false : true;
    }

    protected function confirmAccount($userId, $beSeller) {

        $table = 'fashionrecovery.GR_001';
        $user  = DB::table($table)->where('id',$userId)->first();

        if($user->Confirmed) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            DB::table($table)
                ->where('id',$userId)
                ->update(['Confirmed' => true]);

            // Mail::to($user->email)
            //     ->send(new ConfirmAccount($user));

            DB::commit();

            Session::flash('success','Se ha confirmado la cuenta exitosamente');
            return Redirect::to('login/'.$beSeller);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('login/'.$beSeller);
        }
    }

    protected function resendConfirmAccount($userID) {

        $table = 'fashionrecovery.GR_001';
        $user  = DB::table($table)->where('id',$userId)->first();

        if($user->Confirmed) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            Mail::to($user->email)
                ->send(new ConfirmAccount($user, 0));

            DB::commit();

            Session::flash('success','Se ha confirmado la cuenta exitosamente');
            return Redirect::to('dashboard');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('dashboard');
        }
    }
}