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

            Session::flash('warning','Esta cuenta ya existe. Accede a tu cuenta.');
            return Redirect::to('register/'.$beSeller);
        }

        if($this->existsAlias($request->alias)) {

            Session::flash('warning','El alias ya existe. Intenta con otro.');
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

            Session::flash('success','Tu cuenta ha sido creada. Confirma tu cuenta antes de iniciar sesión.');
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
        $date = false;

        if(isset($data['birth_date'])) {

            $item = str_replace('/', '-', $data['birth_date']);
            $date = date("Y-m-d", strtotime($item));             
        }
        
        return DB::table('fashionrecovery.GR_001')->insert([
             'email'         => $data['email'],
             'password'      => Hash::make($data['password']),
             'Alias'         => $data['alias'],
             'Name'          => $data['name'],
             'Lastname'      => $data['last_name'],
             'Gender'        => $data['gender'],
             'Birthdate'     => $date,
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

    protected function existsAlias($alias) {

        $user = DB::table('fashionrecovery.GR_001')
                  ->where('Alias',$alias)
                  ->first();

        return $user === null ? false : true;
    }




}