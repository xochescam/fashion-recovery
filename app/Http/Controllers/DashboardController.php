<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller
{
 	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	if(Auth::User()) {
    		return view('dashboard.home');
    	}
    	dd('no-log');

    }
}
