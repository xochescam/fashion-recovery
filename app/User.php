<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordNotification;

use App\Module;
use App\ShoppingCart;
use App\Item;
use App\Devolution;

use Auth;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;


    protected $table = 'fashionrecovery.GR_001';
    protected $primaryKey = 'id';

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

        /**
     * Determine if the user may perform the given permission.
     *
     * @param  Module $permission
     * @return boolean
     */
    public function hasPermission(Module $module)
    {
        return $this->hasModule($module->ModuleName);
    }



   /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasModule($moduleName)
    {
        if (is_string($moduleName)) {

            $access = $this->access($moduleName);

            return isset($access->AccessRightID) ? true : false;

        }
    }

    public function order()
    {
        return $this->hasMany('App\Order', 'UserID');
    }

    public function wallet()
    {
        return $this->hasOne('App\Wallet', 'UserID');
    }

    public function infoSeller()
    {
        return $this->hasOne('App\Seller', 'UserID');
    }

    public function devolution()
    {
        return $this->hasMany('App\Devolution', 'UserID');
    }

    public function access($moduleName)
    {
        $module = Module::where('ModuleName',$moduleName)->first();

        return Access::where('ModuleID',$module->ModulesID)
                ->where('ProfileID',Auth::User()->ProfileID)
                ->first();
    }

    public function infoWishlist() {

        return DB::table('fashionrecovery.GR_024')
            ->join('fashionrecovery.GR_037', 'GR_024.WishListID', '=', 'GR_037.WishlistID')
            ->where('GR_024.UserID',Auth::User()->id)
            ->get(['WishListID','ItemID']);        
    }


    public function inWishlist($ItemID) {

        return DB::table('fashionrecovery.GR_024')
            ->join('fashionrecovery.GR_037', 'GR_024.WishListID', '=', 'GR_037.WishlistID')
            ->where('GR_024.UserID',Auth::User()->id)
            ->where('GR_037.ItemID',$ItemID)
            ->first();        
    }

    public function getTotal() {

        /* $shoppingCart = ShoppingCart::where('GR_041.UserID',Auth::User()->id)
                                    ->select(['ItemID'])
                                    ->get()->toArray();

        return Item::whereIn('ItemID',$shoppingCart)
                    ->sum('ActualPrice'); */
           

        $items = DB::table('fashionrecovery.GR_041')
            ->join('fashionrecovery.GR_029', 'GR_041.ItemID', '=', 'GR_029.ItemID')
            ->where('GR_041.UserID',Auth::User()->id)
            ->select('GR_029.ActualPrice')
            ->get(); 

        $total = $items->sum(function ($item) {
            return str_replace(',', '', substr($item->ActualPrice, 1));
        });

        return $total;
    }

    public static function getSum($user) {

        $itemIds = DB::table('fashionrecovery.GR_029')
            ->where('GR_029.OwnerID',$user->id)
            ->where('GR_029.IsSold',true)
            ->get()->groupBy('ItemID')->keys();

        $items = DB::table('fashionrecovery.GR_029')
                ->join('fashionrecovery.GR_022', 'GR_029.ItemID', '=', 'GR_022.ItemID')
                ->whereIn('GR_029.ItemID',$itemIds)
                ->where('GR_022.OrderStatusID',4)
                ->select('GR_022.UpdateDate',
                        'GR_029.IsPaid',
                        'GR_029.ActualPrice'
                )->get();

        return $items->filter(function ($item, $key) use ($user){

            $price = str_replace(',', '', substr($item->ActualPrice, 1));
            $item->Gain = $price - ($price * $user->getCommission($user));

            $current = strtotime(date("Y-m-d H:i:s"));
            $update  = strtotime($item->UpdateDate);
            $segs    = $current - $update;
            $days    = $segs / 86400;
                
            return $days > 1 && !$item->IsPaid;
            
        })->sum('Gain');
    }

    public function inCart($ItemID) {

        $item = DB::table('fashionrecovery.GR_041')
            ->where('GR_041.UserID',Auth::User()->id)
            ->where('GR_041.ItemID',$ItemID)
            ->get(); 
            
        return count($item) > 0 ? 1 : 0;
    }

    public function getCollections() {

        return DB::table('fashionrecovery.GR_030')
                ->where('UserID',Auth::User()->id)
                ->get();
        
    }

    public function getWishlists() {

        return DB::table('fashionrecovery.GR_024')
                ->where('UserID',Auth::User()->id)
                ->first();
        
    }

    public function getFollowers() {

        return [
            'followers' => $this->followers(),
            'following' => $this->following()
        ];
    }

    public function followers() {

        return DB::table('fashionrecovery.GR_038')
                 ->join('fashionrecovery.GR_001', 'GR_038.UserID', '=', 'GR_001.id')
/*                 ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')*/
                 ->where('fashionrecovery.GR_038.SellerID',Auth::User()->id)
                ->where('fashionrecovery.GR_001.IsBlocked',false)
                ->select('GR_001.id','GR_001.Alias')
                ->get();
    }

    public function following() {

        return DB::table('fashionrecovery.GR_038')
                 ->join('fashionrecovery.GR_001', 'GR_038.SellerID', '=', 'GR_001.id')
            /*    ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')*/
                ->where('fashionrecovery.GR_038.UserID',Auth::User()->id) 
                ->where('fashionrecovery.GR_001.IsBlocked',false)
                ->select('GR_001.id','GR_001.Alias')
                ->get();
    }

    public function isBuyerProfile() {
        $profile = Auth::User()->ProfileID;

        return $profile == 1 ? true : false;
    }

    public function isSellerProfile() {
        $profile = Auth::User()->ProfileID;

        return $profile == 2 ? true : false;
    }

    public function isAdmin() {
        $profile = Auth::User()->ProfileID;

        return $profile == 4 ? true : false;
    }

    public function isSuperAdmin() {
        $profile = Auth::User()->ProfileID;

        return $profile == 3 ? true : false;
    }

    public function item()
    {
        //return $this->hasMany('App\Item', 'OwnerID');
        return $this->belongsTo('App\Item', 'OwnerID');
    }

    public function allItems()
    {
        return $this->hasMany('App\Item', 'OwnerID');
    }

    public function getShippingAddress() {

        return DB::table('fashionrecovery.GR_002')
                    ->where('UserID',Auth::User()->id)
                    ->get();
    }

    public function getDefaultAddress() {

        return DB::table('fashionrecovery.GR_002')
                 ->where('UserID',Auth::User()->id)
                 ->where('IsDefault',true)
                 ->first();
    }

    public function getNotifications() {

        $notifications = DB::table('fashionrecovery.GR_040')
                    ->where('UserID',Auth::User()->id)
                    ->get();

        return $notifications;
    }

    public function  getItems() {

        $itemIds = DB::table('fashionrecovery.GR_041')
                    ->join('fashionrecovery.GR_001', 'GR_041.UserID', '=', 'GR_001.id')
                    ->where('GR_041.UserID',Auth::User()->id)
                    ->where('GR_001.IsBlocked',false)
                    ->get()->groupBy('ItemID')->keys();
                    
        return $this->items($itemIds);
    }

    public function getOrdered() {

        $order = DB::table('fashionrecovery.GR_021')
                    ->where('GR_021.UserID',Auth::User()->id)
                    ->orderBy('CreationDate', 'desc')
                    ->first()
                    ->OrderID;

        $itemIds = DB::table('fashionrecovery.GR_022')
                    ->where('GR_022.OrderID',$order)
                    ->get()->groupBy('ItemID')->keys();

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->whereIn('GR_029.ItemID',$itemIds)
                    ->select('GR_029.ItemID',
                             'GR_029.OffSaleID',
                             'GR_029.ItemDescription',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_029.SizeID',
                             'GR_029.BrandID',
                             'GR_001.Alias',
                             'GR_001.id as UserID'
                        )->get();
        
        return $this->infoItem($items);
    }

    public function items($itemIds) {

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_041', 'GR_029.ItemID', '=', 'GR_041.ItemID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->whereIn('GR_029.ItemID',$itemIds)
                    ->where('GR_041.UserID',Auth::User()->id)
                    ->select('GR_029.ItemID',
                             'GR_029.OffSaleID',
                             'GR_029.ItemDescription',
                             'GR_029.OriginalPrice',
                             'GR_029.ActualPrice',
                             'GR_029.SizeID',
                             'GR_029.BrandID',
                             'GR_041.ShoppingCartID',
                             'GR_001.Alias',
                             'GR_001.id as UserID'
                        )->get();
        
        return $this->infoItem($items);
    }

    public function infoItem($items) {
        $sub = 0;

        foreach ($items as $key => $item) {
            $sub += floatval(ltrim($item->ActualPrice,'$'));
        }
        
        return $items->map(function ($item, $key) use ($sub){

            $item->ThumbPath = $this->getThumbPath($item);
            $item->BrandName = $this->getBrand($item);
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

    public static function getBuyItems($user) {
        
        $order = DB::table('fashionrecovery.GR_021')
                    ->where('UserID',$user->id)
                    ->get()->groupBy('OrderID')->keys();
        
        return DB::table('fashionrecovery.GR_022')
                    ->whereIn('OrderID',$order)
                    ->whereIn('OrderStatusID',[4,5,9,10])
                    ->count();
    }

    public static function getSoldItems($user) {

        return Item::where('OwnerID',$user->id)
                    ->where('IsSold',true)->count();
    }

    public static function getCommission($user) {

        $user = !$user ? Auth::User() : $user;

        $count = User::getSoldItems($user);

        if($count >= 301) {

            $commission = 0.18;

        } else if($count >= 101) {

            $commission = 0.19;

        } else if($count >= 0) {

            $commission = 0.20;
        }

        return $commission;
    }
}