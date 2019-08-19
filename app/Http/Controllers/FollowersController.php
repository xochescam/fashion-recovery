<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\NewFollower;

use DB;
use Auth;
use Session;
use Redirect;
use Mail;

class FollowersController extends Controller
{
	protected $table = 'fashionrecovery.GR_038';

    public function getFollowers() {

        $followers  = $this->followers();

        $following  = $this->following();

        return view('seller.followers',compact('followers','following'));
    }

    public function follow($sellerID) {

    	if(!$this->exists($sellerID)) {
    		Session::flash('warning','El vendedor no existe en nuestros registros.');
            return Redirect::back();
    	}

    	if(Auth::User()->id == $sellerID) {
    		Session::flash('warning','¡Lo sentimos! No puedes seguirte a ti mismo.');
            return Redirect::back();
    	}

    	if($this->isFollowing($sellerID)) {
    		Session::flash('warning','Ya estás siguiendo a este usuario.');
            return Redirect::back();
    	}

    	$follower = DB::table($this->table)
    					->insert([
    						'UserID'   => Auth::User()->id,
    						'SellerID' => $sellerID
    					]);

        $follower = $this->getLast();

        $user = DB::table('fashionrecovery.GR_001')
                    ->where('id',$sellerID)->first();

        $this->saveNotifications($user, $follower);

        Mail::to($user->email)
                 ->send(new NewFollower($user, Auth::User()));

    	Session::flash('warning','Siguiendo.');
        return Redirect::back();
    }

    public function unfollow($sellerID) {

    	if(!$this->exists($sellerID)) {
    		Session::flash('warning','El vendedor no existe en nuestros registros.');
            return Redirect::back();
    	}

    	if(Auth::User()->id == $sellerID) {
    		Session::flash('warning','¡Lo sentimos! No puedes seguirte a ti mismo.');
            return Redirect::back();
    	}

    	$follower = DB::table($this->table)
                        ->where('GR_038.UserID',Auth::User()->id)
                        ->where('GR_038.SellerID',$sellerID)
                        ->delete();

        Session::flash('warning','Dejar de seguir.');
        return Redirect::back();
    }

    public function followers() {

        return DB::table($this->table)
                ->join('fashionrecovery.GR_001', 'GR_038.UserID', '=', 'GR_001.id')
                ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')
                ->where('fashionrecovery.GR_038.SellerID',Auth::User()->id)
                ->select('GR_001.id','GR_001.Alias','GR_033.SelfieThumbPath')
                ->get();
    }

    public function following() {

        return DB::table($this->table)
                ->join('fashionrecovery.GR_001', 'GR_038.SellerID', '=', 'GR_001.id')
                ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')
                ->where('fashionrecovery.GR_038.UserID',Auth::User()->id)
                ->select('GR_001.id','GR_001.Alias','GR_033.SelfieThumbPath')
                ->get();
    }

    public function isFollowing($sellerID) {

		$isFollowing = DB::table($this->table)
			           	->where('GR_038.UserID',Auth::User()->id)
			            ->where('GR_038.SellerID',$sellerID)
			            ->get();

		return $isFollowing->count() ? true : false;
    }

    public function exists($sellerID) {

    	$exists = DB::table('fashionrecovery.GR_001')
                    ->where('GR_001.id',$sellerID)
                    ->where('GR_001.ProfileID',2)
                    ->get();

        return !$exists->count() ? false : true;
    }

    public function getLast() {

        return DB::table($this->table)
                    ->where('UserID',Auth::User()->id)
                    ->orderBy('CreationDate', 'desc')
                    ->first();
    }

    public function saveNotifications($user, $follower) {

        DB::table('fashionrecovery.GR_040')->insert([
            'Type'        => 'follower',
            'UserID'      => $user->id,
            'TableID'     => $follower->UserID,
            'TableNameID' => 'UserID',
            'TableName'   => 'GR_038'
        ]);

        DB::table('fashionrecovery.GR_001')
            ->where('id', $user->id)
            ->update(['Notifications' => True]);

        return true;
    }
}
