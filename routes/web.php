<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index');


Auth::routes();

//footer
Route::view('support', 'footer.support');
Route::view('faq', 'footer.faq');
Route::view('terms', 'footer.terms');
Route::view('privacy', 'footer.privacy');
Route::view('return-policy', 'footer.return-policy');
Route::view('about', 'footer.about');

Route::get('confirm-account/{userID}/{beSeller}', 'AuthController@confirmAccount');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('login/{beSeller}','Auth\LoginController@getForm')->name('login');
Route::post('login/{beSeller}','Auth\LoginController@login');

Route::get('register/{beSeller}','Auth\RegisterController@getForm');
Route::post('register/{beSeller}','Auth\RegisterController@register');

Route::get('items/{itemId}/public', 'ItemController@publicShow');

Route::get('user/{alias}', 'SellerController@show');

//Filter
Route::post('filter', 'SearchController@filter');

//Department
Route::get('search/{type}/{search}', 'SearchController@searchByLink');

//Clothing filters
Route::post('filter/{clothingFilter}/', 'SearchController@ClothingFilter');

Route::get('delete-secret/{id}/', 'SellerController@deleteSecret');

Route::post('newsletter', 'HomeController@newsletter');

	
//Search
Route::get('search/{search}', 'SearchController@search');

Route::group(['middleware' => ['auth']], function () {

	
	Route::get('transfer', 'SellerController@transfer');

	//sells
	Route::get('sales', 'SellController@index');
	Route::get('sell/{SellID}/update', 'SellController@update');

	//orders
	Route::get('orders', 'OrderController@index');
	Route::get('cancel-order/{GuideID}', 'OrderController@cancel');

	//Notifications
	Route::get('notification', 'NotificationController@show');
	Route::post('notification-delete', 'NotificationController@destroy');

	//payment
	Route::get('payment/{ShippingAddID}/{IsBuy}', 'PaymentController@payment');
	Route::get('summary/{ShippingAddID}', 'PaymentController@summary');
	Route::get('confirmation/{ShippingAddID}', 'PaymentController@confirmation');

	Route::post('payment-card', 'PaymentController@paymentCard');


	//Route::get('confirm/{ShippingAddID}', 'ConfirmBuyController@confirm');


	//Shopping cart
	Route::get('add-to-cart/{ItemID}', 'ShoppingCartController@addItem');
	Route::get('delete-to-cart/{ItemID}', 'ShoppingCartController@deleteItem');
	Route::get('shopping-cart', 'ShoppingCartController@items');


	//Questions
	Route::post('question', 'QuestionController@question');
	Route::get('question/{questionID}/{type}', 'QuestionController@answer');
	Route::post('question/{type}', 'QuestionController@storeAnswer');

	//Followers
	Route::get('follow/{sellerID}', 'FollowersController@follow');
	Route::get('unfollow/{sellerID}', 'FollowersController@unfollow');
	Route::get('followers', 'FollowersController@getFollowers');

	//Item API
	Route::get('brands-by-department/{departmentId}', 'ItemApiController@getBrandsbyDepartment');
	Route::get('clothing-type-by-brand/{departmentId}/{brandId}/{categoryId}', 'ItemApiController@getClothingTypebyBrand');
	Route::get('clothing-type-only-by-brand/{departmentId}/{brandId}', 'ItemApiController@getClothingTypeOnlybyBrand');
	Route::get('sizes-by-clothing-type/{departmentId}/{brandId}/{clothingTypeId}', 'ItemApiController@getSizesbyClothingType');

	//Shipping
	Route::get('add-address/{type_url}', 'ShippingAddressController@create');
	Route::get('address/{ShippingAddID}/{type_url}', 'ShippingAddressController@edit');
	Route::get('address', 'ShippingAddressController@index');
	Route::post('shipping', 'ShippingAddressController@store');
	Route::post('shipping/{shippingAddId}', 'ShippingAddressController@update');
	Route::get('shipping/{shippingAddId}/delete', 'ShippingAddressController@destroy')->name('shippings.destroy');


	//Billing Info
	Route::post('billing-info', 'BillingInfoController@store');
	Route::post('billing-info/{billingInfoId}', 'BillingInfoController@update');

	//Guardarropas
	Route::get('guardarropa', 'ClosetController@ownClosets');

	//Wishlist
	Route::get('wishlists', 'WishlistController@index');
	Route::get('wishlist/{WishlistID}', 'WishlistController@show')->name('wishlists.show');
	Route::get('wishlist/{ItemID}/create', 'WishlistController@store')->name('wishlists.store');
	Route::get('wishlist/{WishlistID}/{ItemID}/exists', 'WishlistController@existingWishlist');
	Route::get('wishlist/{WishlistID}/edit', 'WishlistController@edit')->name('wishlists.edit');
	Route::post('wishlist/{WishlistID}', 'WishlistController@update')->name('wishlists.update');
	Route::get('wishlist/{WishlistID}/delete', 'WishlistController@destroy')->name('wishlists.destroy');
	Route::get('wishlist/{WishlistID}/{ItemID}/add', 'WishlistController@addToWishlist');
	Route::get('wishlist/{WishlistID}/{ItemID}/delete', 'WishlistController@removeFromWishlist');
	

	//Dashboard
	Route::get('dashboard', 'DashboardController@index');

	//Auth user
	Route::get('auth/{authId}/edit', 'AuthController@edit');
	Route::post('auth/{authId}', 'AuthController@update');
	Route::get('account', 'AuthController@show');

	//Seller
	Route::get('seller', 'SellerController@create');
	Route::post('seller', 'SellerController@store');
	Route::get('seller/{sellerId}/edit', 'SellerController@edit');
	Route::post('seller/{sellerId}', 'SellerController@update');

	Route::get('resend-confirm-account/{userId}', 'AuthController@resend');

	Route::post('update-selfie/{userId}', 'SellerController@updateSelfie');
	//Route::get('welcome/seller', 'SellerController@sellerWelcome');

	Route::get('update/{Type}/{IsPaused}/{ItemID}', 'SellerController@guardarropaStatus');
	Route::get('closet/update/{Type}/{IsPaused}/{ItemID}', 'SellerController@guardarropaStatus');

	//Item
	Route::get('items', 'ItemController@index');
	Route::get('item', 'ItemController@create');
	Route::post('item', 'ItemController@store');
	Route::get('item/{itemId}', 'ItemController@show');
	Route::post('item/{itemId}', 'ItemController@update')->name('item.update');
	Route::get('item/{id}/{itemId}/delete', 'ItemController@destroy')->name('item.destroy');
	Route::get('item/{itemId}/full-delete', 'ItemController@fullDestroy')->name('item.fullDestroy');
	Route::post('add-items/{itemId}', 'ItemController@addItem');

	//Closet
	Route::get('closets', 'ClosetController@index');
	Route::get('closet', 'ClosetController@create');
	Route::post('closet', 'ClosetController@store');
	Route::get('closet/{closetId}', 'ClosetController@show')->name('closet.show');
	Route::get('closet/{closetId}/edit', 'ClosetController@edit')->name('closet.edit');
	Route::post('closet/{closetId}', 'ClosetController@update')->name('closet.update');
	Route::get('closet/{closetId}/delete', 'ClosetController@destroy')->name('closet.destroy');

	//Update password
	Route::view('update-password', 'auth.passwords.update');
	Route::post('update-password', 'Auth\PasswordController@update');

	//Brands
	Route::get('brands', 'Catalogs\BrandController@index');
	Route::get('brands/create', 'Catalogs\BrandController@create')->name('brands.create');
	Route::post('brands', 'Catalogs\BrandController@store')->name('brands.store');
	Route::get('brands/{brandId}/edit', 'Catalogs\BrandController@edit')->name('brands.edit');
	Route::post('brands/{brandId}', 'Catalogs\BrandController@update')->name('brands.update');
	Route::get('brands/{brandId}/delete', 'Catalogs\BrandController@destroy')->name('brands.destroy');
	Route::get('brands/{brandId}/validate', 'Catalogs\BrandController@verify')->name('brands.validate');
	
	//Departments
	Route::get('departments', 'Catalogs\DepartmentController@index');
	Route::get('departments/create', 'Catalogs\DepartmentController@create')->name('departments.create');
	Route::post('departments', 'Catalogs\DepartmentController@store')->name('departments.store');
	Route::get('departments/{departmentId}/edit', 'Catalogs\DepartmentController@edit')->name('departments.edit');
	Route::post('departments/{departmentId}', 'Catalogs\DepartmentController@update')->name('departments.update');
	Route::get('departments/{departmentId}/delete', 'Catalogs\DepartmentController@destroy')->name('departments.destroy');

	//Categories
	Route::get('categories', 'Catalogs\CategoryController@index');
	Route::get('categories/create', 'Catalogs\CategoryController@create')->name('categories.create');
	Route::post('categories', 'Catalogs\CategoryController@store')->name('categories.store');
	Route::get('categories/{categoryId}/edit', 'Catalogs\CategoryController@edit')->name('categories.edit');
	Route::post('categories/{categoryId}', 'Catalogs\CategoryController@update')->name('categories.update');
	Route::get('categories/{categoryId}/delete', 'Catalogs\CategoryController@destroy')->name('categories.destroy');

	//Types
	Route::get('types', 'Catalogs\TypeController@index');
	Route::get('types/create', 'Catalogs\TypeController@create')->name('types.create');
	Route::post('types', 'Catalogs\TypeController@store')->name('types.store');
	Route::get('types/{typeId}/edit', 'Catalogs\TypeController@edit')->name('types.edit');
	Route::post('types/{typeId}', 'Catalogs\TypeController@update')->name('types.update');
	Route::get('types/{typeId}/delete', 'Catalogs\TypeController@destroy')->name('types.destroy');

	//Colors
	Route::get('colors', 'Catalogs\ColorController@index');
	Route::get('colors/create', 'Catalogs\ColorController@create')->name('colors.create');
	Route::post('colors', 'Catalogs\ColorController@store')->name('colors.store');
	Route::get('colors/{colorId}/edit', 'Catalogs\ColorController@edit')->name('colors.edit');
	Route::post('colors/{colorId}', 'Catalogs\ColorController@update')->name('colors.update');
	Route::get('colors/{colorId}/delete', 'Catalogs\ColorController@destroy')->name('colors.destroy');

	//Sizes
	Route::get('sizes', 'Catalogs\SizeController@index');
	Route::get('sizes/create', 'Catalogs\SizeController@create')->name('sizes.create');
	Route::post('sizes', 'Catalogs\SizeController@store')->name('sizes.store');
	Route::get('sizes/{sizeId}/edit', 'Catalogs\SizeController@edit')->name('sizes.edit');
	Route::post('sizes/{sizeId}', 'Catalogs\SizeController@update')->name('sizes.update');
	Route::get('sizes/{sizeId}/delete', 'Catalogs\SizeController@destroy')->name('sizes.destroy');

	//Clothing types
	Route::get('clothing-types', 'Catalogs\ClothingTypeController@index');
	Route::get('clothing-types/create', 'Catalogs\ClothingTypeController@create')->name('clothing-types.create');
	Route::post('clothing-types', 'Catalogs\ClothingTypeController@store')->name('clothing-types.store');
	Route::get('clothing-types/{clothingTypeId}/edit', 'Catalogs\ClothingTypeController@edit')->name('clothing-types.edit');
	Route::post('clothing-types/{clothingTypeId}', 'Catalogs\ClothingTypeController@update')->name('clothing-types.update');
	Route::get('clothing-types/{clothingTypeId}/delete', 'Catalogs\ClothingTypeController@destroy')->name('clothing-types.destroy');

	//Seasons
	Route::get('seasons', 'Catalogs\SeasonController@index');
	Route::get('seasons/create', 'Catalogs\SeasonController@create')->name('seasons.create');
	Route::post('seasons', 'Catalogs\SeasonController@store')->name('seasons.store');
	Route::get('seasons/{seasonId}/edit', 'Catalogs\SeasonController@edit')->name('seasons.edit');
	Route::post('seasons/{seasonId}', 'Catalogs\SeasonController@update')->name('seasons.update');
	Route::get('seasons/{seasonId}/delete', 'Catalogs\SeasonController@destroy')->name('seasons.destroy');

	//Calendario de ofertas
	Route::get('calendar-sales', 'Catalogs\CalendarSaleController@index');
	Route::get('calendar-sales/create', 'Catalogs\CalendarSaleController@create')->name('calendar-sales.create');
	Route::post('calendar-sales', 'Catalogs\CalendarSaleController@store')->name('calendar-sales.store');
	Route::get('calendar-sales/{calendarSaleId}/edit', 'Catalogs\CalendarSaleController@edit')->name('calendar-sales.edit');
	Route::post('calendar-sales/{calendarSaleId}', 'Catalogs\CalendarSaleController@update')->name('calendar-sales.update');
    Route::get('calendar-sales/{calendarSaleId}/delete', 'Catalogs\CalendarSaleController@destroy')->name('calendar-sales.destroy');

	Route::get('users', 'UserController@index');
	Route::get('block/{user}', 'UserController@block');
	Route::get('unblock/{user}', 'UserController@unblock');
});
