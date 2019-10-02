<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show() {

    	$user = Auth::User();

    	DB::table('fashionrecovery.GR_001')
            ->where('id', $user->id)
            ->update(['Notifications' => False]);
    }
}
