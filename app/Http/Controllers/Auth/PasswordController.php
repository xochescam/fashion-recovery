<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Session;
use Redirect;
use Hash;
use DB;

class PasswordController extends Controller
{
    public function update(Request $request) {

    	$this->validator($request);

        $user = Auth::User();

        if (Hash::check($request->current_password, $user->password)) {

        	DB::table('fashionrecovery.GR_001')
	            ->where('id', Auth::User()->id)
	            ->update(['password' => bcrypt($request->password)]);

	        Session::flash('success','Se ha cambiado la contraseña exitosamente');
	        return Redirect::to('update-password');
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
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6',
        ]);
    }
}
