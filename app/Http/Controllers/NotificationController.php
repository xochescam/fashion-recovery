<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Gate;

class NotificationController extends Controller
{
    public function show() {

        if (Gate::denies('show-notifications')) {
            abort(403);
        }

    	$user = Auth::User();

    	DB::table('fashionrecovery.GR_001')
            ->where('id', $user->id)
            ->update(['Notifications' => False]);
    }

    public function destroy() {

        if (Gate::denies('delete-notifications')) {
            abort(403);
        }

        DB::delete('DELETE FROM fashionrecovery."GR_040" WHERE "UserID"='.Auth::User()->id);

        return response()->json("success");
    }
}
