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

Route::get('/', function () {
	//Auth::logout();
    return view('home');
});

Auth::routes();

//prov
Route::view('data', 'data');

//footer
Route::view('support', 'footer.support');
Route::view('faq', 'footer.faq');
Route::view('terms', 'footer.terms');
Route::view('privacy', 'footer.privacy');
Route::view('return-policy', 'footer.return-policy');
Route::view('about', 'footer.about');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {

	//Dashboard
	Route::get('dashboard', 'DashboardController@index');

	//Update password
	Route::view('update-password', 'auth.passwords.update');
	Route::post('update-password', 'Auth\PasswordController@update');

	//Brands
	Route::get('brands', 'Admin\BrandController@index');
	Route::get('brands/create', 'Admin\BrandController@create')->name('brands.create');
	Route::post('brands', 'Admin\BrandController@store')->name('brands.store');
	Route::get('brands/{brandId}/edit', 'Admin\BrandController@edit')->name('brands.edit');
	Route::post('brands/{brandId}', 'Admin\BrandController@update')->name('brands.update');
	Route::get('brands/{brandId}/delete', 'Admin\BrandController@destroy')->name('brands.destroy');

	//Departments
	Route::get('departments', 'Admin\DepartmentController@index');
	Route::get('departments/create', 'Admin\DepartmentController@create')->name('departments.create');
	Route::post('departments', 'Admin\DepartmentController@store')->name('departments.store');
	Route::get('departments/{departmentId}/edit', 'Admin\DepartmentController@edit')->name('departments.edit');
	Route::post('departments/{departmentId}', 'Admin\DepartmentController@update')->name('departments.update');
	Route::get('departments/{departmentId}/delete', 'Admin\DepartmentController@destroy')->name('departments.destroy');

	//Categories
	Route::get('categories', 'Admin\CategoryController@index');
	Route::get('categories/create', 'Admin\CategoryController@create')->name('categories.create');
	Route::post('categories', 'Admin\CategoryController@store')->name('categories.store');
	Route::get('categories/{categoryId}/edit', 'Admin\CategoryController@edit')->name('categories.edit');
	Route::post('categories/{categoryId}', 'Admin\CategoryController@update')->name('categories.update');
	Route::get('categories/{categoryId}/delete', 'Admin\CategoryController@destroy')->name('categories.destroy');

	//Types
	Route::get('types', 'Admin\TypeController@index');
	Route::get('types/create', 'Admin\TypeController@create')->name('types.create');
	Route::post('types', 'Admin\TypeController@store')->name('types.store');
	Route::get('types/{typeId}/edit', 'Admin\TypeController@edit')->name('types.edit');
	Route::post('types/{typeId}', 'Admin\TypeController@update')->name('types.update');
	Route::get('types/{typeId}/delete', 'Admin\TypeController@destroy')->name('types.destroy');

	//Colors
	Route::get('colors', 'Admin\ColorController@index');
	Route::get('colors/create', 'Admin\ColorController@create')->name('colors.create');
	Route::post('colors', 'Admin\ColorController@store')->name('colors.store');
	Route::get('colors/{colorId}/edit', 'Admin\ColorController@edit')->name('colors.edit');
	Route::post('colors/{colorId}', 'Admin\ColorController@update')->name('colors.update');
	Route::get('colors/{colorId}/delete', 'Admin\ColorController@destroy')->name('colors.destroy');

	//Sizes
	Route::get('sizes', 'Admin\SizeController@index');
	Route::get('sizes/create', 'Admin\SizeController@create')->name('sizes.create');
	Route::post('sizes', 'Admin\SizeController@store')->name('sizes.store');
	Route::get('sizes/{sizeId}/edit', 'Admin\SizeController@edit')->name('sizes.edit');
	Route::post('sizes/{sizeId}', 'Admin\SizeController@update')->name('sizes.update');
	Route::get('sizes/{sizeId}/delete', 'Admin\SizeController@destroy')->name('sizes.destroy');

	//Clothing types
	Route::get('clothing-types', 'Admin\ClothingTypeController@index');
	Route::get('clothing-types/create', 'Admin\ClothingTypeController@create')->name('clothing-types.create');
	Route::post('clothing-types', 'Admin\ClothingTypeController@store')->name('clothing-types.store');
	Route::get('clothing-types/{clothingTypeId}/edit', 'Admin\ClothingTypeController@edit')->name('clothing-types.edit');
	Route::post('clothing-types/{clothingTypeId}', 'Admin\ClothingTypeController@update')->name('clothing-types.update');
	Route::get('clothing-types/{clothingTypeId}/delete', 'Admin\ClothingTypeController@destroy')->name('clothing-types.destroy');

	//Seasons
	Route::get('seasons', 'Admin\SeasonController@index');
	Route::get('seasons/create', 'Admin\SeasonController@create')->name('seasons.create');
	Route::post('seasons', 'Admin\SeasonController@store')->name('seasons.store');
	Route::get('seasons/{seasonId}/edit', 'Admin\SeasonController@edit')->name('seasons.edit');
	Route::post('seasons/{seasonId}', 'Admin\SeasonController@update')->name('seasons.update');
	Route::get('seasons/{seasonId}/delete', 'Admin\SeasonController@destroy')->name('seasons.destroy');

	//Calendario de ofertas
	Route::get('calendar-sales', 'Admin\CalendarSaleController@index');
	Route::get('calendar-sales/create', 'Admin\CalendarSaleController@create')->name('calendar-sales.create');
	Route::post('calendar-sales', 'Admin\CalendarSaleController@store')->name('calendar-sales.store');
	Route::get('calendar-sales/{calendarSaleId}/edit', 'Admin\CalendarSaleController@edit')->name('calendar-sales.edit');
	Route::post('calendar-sales/{calendarSaleId}', 'Admin\CalendarSaleController@update')->name('calendar-sales.update');
	Route::get('calendar-sales/{calendarSaleId}/delete', 'Admin\CalendarSaleController@destroy')->name('calendar-sales.destroy');
});
