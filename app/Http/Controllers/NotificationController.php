<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class NotificationController extends Controller
{
    public function show() {

    	$user = Auth::User();

    	DB::table('fashionrecovery.GR_001')
            ->where('id', $user->id)
            ->update(['Notifications' => False]);
    }

    public function destroy() {

        DB::delete('DELETE FROM fashionrecovery."GR_040" WHERE "UserID"='.Auth::User()->id);

        return response()->json("success");
    }
}
