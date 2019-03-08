<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class DashboardController extends Controller
{
 	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return DB::table('fashionrecovery.GR_001')->get();

    	if(Auth::User()) {
    		return view('dashboard.home');
    	}
    	dd('no-log');

    }
}
