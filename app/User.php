<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordNotification;

use Auth;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'fashionrecovery.GR_001';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','name','id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function isBuyerProfile() {
        $profile = Auth::User()->ProfileID;

        return $profile == 1 ? true : false;
    }

    public function isSellerProfile() {
        $profile = Auth::User()->ProfileID;

        return $profile == 2 ? true : false;
    }

    public function getNotifications() {

        $notifications = DB::table('fashionrecovery.GR_040')
                    ->where('UserID',Auth::User()->id)
                    ->get();

        // $notifications = $all->map(function ($item, $key){

        //     dd($data);

        //     if() {

        //     }

        //     $data = DB::table('fashionrecovery.'.$item->TableName)
        //                 ->where($item->TableNameID,$item->TableID)
        //                 ->first();

        //     dd($data);

        //     return $item;
        // });

        return $notifications;
    }
}