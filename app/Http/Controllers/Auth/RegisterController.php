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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name'            => ['required', 'max:80'],
            'last_name'       => ['required', 'max:80'],
            'email'           => ['required', 'email', 'max:100'],
            'password'        => ['required', 'min:6'],
            'alias'           => ['required','max:30'],
            'gender'          => ['required'],
            'birth_date'      => ['required', 'date','before:'.date("Y-m-d")],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request);

        if($this->existsEmail($request->email)) {

            Session::flash('warning','Esta cuenta ya existe. Accede a tu cuenta');
            return Redirect::to('/register');
        }

        DB::beginTransaction();

        try {

            event(new Registered($user = $this->create($request->all())));

            $user = DB::table('fashionrecovery.GR_001')
                        ->where('email',$request->email)
                        ->first();

            Mail::to($user->email)
                ->send(new ConfirmAccount($user));

             DB::commit();

            Session::flash('success','Se ha registrado correctamente');
            return $this->registered($request, $user)
                            ?: redirect($this->redirectPath());

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('/register');
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

    protected function confirmAccount($userId) {

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

            Mail::to($user->email)
                ->send(new ConfirmAccount($user));

            DB::commit();

            Session::flash('success','Se ha confirmado la cuenta exitosamente');
            return Redirect::to('/login');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('/login');
        }
    }
}