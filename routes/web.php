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

Route::get('login/{beSeller}','Auth\LoginController@getForm');
Route::post('login/{beSeller}','Auth\LoginController@login');

Route::get('register/{beSeller}','Auth\RegisterController@getForm');
Route::post('register/{beSeller}','Auth\RegisterController@register');


Route::group(['middleware' => ['auth']], function () {

	Route::get('departments-by-brand/{brandId}', 'ItemApiController@getDepartmentsByBrand');

	//Guardarropas
	Route::get('guardarropa', 'ClosetController@ownClosets');
	
	//Dashboard
	Route::get('dashboard', 'DashboardController@index');

	//Auth user
	Route::get('auth/{authId}/edit', 'AuthController@edit');
	Route::post('auth/{authId}', 'AuthController@update');
	Route::get('auth/{authId}', 'AuthController@show');

	//Seller
	Route::get('seller', 'SellerController@create');
	Route::post('seller', 'SellerController@store');
	Route::get('seller/{sellerId}/edit', 'SellerController@edit');
	Route::post('seller/{sellerId}', 'SellerController@update');

	Route::get('resend-confirm-account/{userId}', 'AuthController@resend');

	Route::post('update-selfie/{userId}', 'SellerController@updateSelfie');

	//Item
	Route::get('items', 'ItemController@index');
	Route::get('item', 'ItemController@create');
	Route::post('item', 'ItemController@store');
	Route::get('item/{itemId}', 'ItemController@show');
	Route::get('item/{itemId}/edit', 'ItemController@edit');
	Route::post('item/{itemId}', 'ItemController@update')->name('item.update');
	Route::get('item/{itemId}/delete', 'ItemController@destroy')->name('item.destroy');
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
});