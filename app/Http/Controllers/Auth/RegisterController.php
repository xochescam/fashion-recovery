<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;

use DB;
use Session;

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
    protected $redirectTo = '/register';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'            => ['required', 'max:80'],
            'last_name'       => ['required', 'max:80'],
            'email'           => ['required', 'email', 'unique:GR_001', 'max:100'],
            'password'        => ['required'], //validations
            'alias'           => ['max:30'],
            'gender'          => ['required'],
            'birth_date'      => ['required', 'date'],
            //'notifications' => ['required', 'string', 'max:255'],
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
        $this->validator($request->all());

        event(new Registered($user = $this->create($request->all())));

        Session::flash('success','Se ha registrado correctamente');

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            [
             'UserID'           => 8,
             'Email'           => '{'.$data['email'].'}',
             'Password'         => Hash::make($data['password']),
             'Alias'            => '{'.$data['alias'].'}',
             'Name'             => '{'.$data['name'].'}',
             'Lastname'         => '{'.$data['last_name'].'}',
             'Gender'           => '{'.$data['gender'].'}',
             'Birthdate'        => $data['birth_date'],
             'ProfileID'        => 1,
             'StatusID'         => 2,
             'CreatedFrom'      => 3,
             'CreationDate'     => '00:00:00',
             'Confirmed'        => true,
             'ConfirmationDate' => '1962-06-16 00:00:00',
             'CancelationDate'  => '1962-06-16 00:00:00',
            ]
        ]);
    }
}
