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

    public function getShippingAddress() {

        return DB::table('fashionrecovery.GR_002')
                    ->where('UserID',Auth::User()->id)
                    ->get();
    }

    public function getNotifications() {

        $notifications = DB::table('fashionrecovery.GR_040')
                    ->where('UserID',Auth::User()->id)
                    ->get();

        return $notifications;
    }

    public function  getItems() {

        $itemIds = DB::table('fashionrecovery.GR_041')
                    ->where('GR_041.UserID',Auth::User()->id)
                    ->get()->groupBy('ItemID')->keys();


        $items = DB::table('fashionrecovery.GR_029')
                        ->join('fashionrecovery.GR_041', 'GR_029.ItemID', '=', 'GR_041.ItemID')
                        ->whereIn('GR_029.ItemID',$itemIds)
                        ->select('GR_029.ItemID',
                                 'GR_029.OffSaleID',
                                 'GR_029.ItemDescription',
                                 'GR_029.OriginalPrice',
                                 'GR_029.ActualPrice',
                                 'GR_029.SizeID',
                                 'GR_029.BrandID',
                                 'GR_041.ShoppingCartID'
                             )->get();

        $sub = 0;
        
        foreach ($items as $key => $item) {
            $sub += floatval(ltrim($item->ActualPrice,'$'));
        }
        
        return $items->map(function ($item, $key) use ($sub){

            $item->ThumbPath = $this->getThumbPath($item);
            $item->BrandID   = $this->getBrand($item);
            $item->SizeID    = $this->getSize($item);
            $item->sub       = $sub;

            return $item;
        });
    }

    public function getThumbPath($item) {

        return DB::table('fashionrecovery.GR_032')
            ->where('ItemID',$item->ItemID)
            ->get()->first()->ThumbPath;
    }

    public function getBrand($item) {

        return isset($item->BrandID) ? 
                DB::table('fashionrecovery.GR_017')
                    ->where('BrandID',$item->BrandID)
                    ->first()->BrandName : 
                DB::table('fashionrecovery.GR_036')
                    ->where('ItemID',$item->ItemID)
                    ->first()->OtherBrand;
    }

    public function getSize($item) {

        return isset($item->BrandID) ? 
                 DB::table('fashionrecovery.GR_020')
                     ->where('SizeID',$item->SizeID)
                     ->first()->SizeName : 
                 DB::table('fashionrecovery.GR_036')
                     ->where('ItemID',$item->ItemID)
                     ->first()->OtherSize;
    }


}