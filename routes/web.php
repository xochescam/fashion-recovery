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

	Route::get('dashboard', 'DashboardController@index');

	//Brands
	Route::get('brands', 'Admin\BrandController@index');
	Route::get('brands/create', 'Admin\BrandController@create')->name('brands.create');
	Route::post('brands', 'Admin\BrandController@store')->name('brands.store');
	Route::get('brands/{brandId}/edit', 'Admin\BrandController@edit')->name('brands.edit');
	Route::post('brands/{brandId}', 'Admin\BrandController@update')->name('brands.update');
	Route::get('brands/{brandId}/delete', 'Admin\BrandController@destroy')->name('brands.destroy');

	//Departments
	Route::get('departments', 'DepartmentController@index');
	Route::get('departments/create', 'DepartmentController@create')->name('departments.create');
	Route::post('departments', 'DepartmentController@store')->name('departments.store');
	Route::get('departments/{departmentId}/edit', 'DepartmentController@edit')->name('departments.edit');
	Route::post('departments/{departmentId}', 'DepartmentController@update')->name('departments.update');
	Route::get('departments/{departmentId}/delete', 'DepartmentController@destroy')->name('departments.destroy');

	//Categories
	Route::get('categories', 'CategoryController@index');
	Route::get('categories/create', 'CategoryController@create')->name('categories.create');
	Route::post('categories', 'CategoryController@store')->name('categories.store');
	Route::get('categories/{categoryId}/edit', 'CategoryController@edit')->name('categories.edit');
	Route::post('categories/{categoryId}', 'CategoryController@update')->name('categories.update');
	Route::get('categories/{categoryId}/delete', 'CategoryController@destroy')->name('categories.destroy');

	//Types
	Route::get('types', 'TypeController@index');
	Route::get('types/create', 'TypeController@create')->name('types.create');
	Route::post('types', 'TypeController@store')->name('types.store');
	Route::get('types/{typeId}/edit', 'TypeController@edit')->name('types.edit');
	Route::post('types/{typeId}', 'TypeController@update')->name('types.update');
	Route::get('types/{typeId}/delete', 'TypeController@destroy')->name('types.destroy');

	//Colors
	Route::get('colors', 'ColorController@index');
	Route::get('colors/create', 'ColorController@create')->name('colors.create');
	Route::post('colors', 'ColorController@store')->name('colors.store');
	Route::get('colors/{colorId}/edit', 'ColorController@edit')->name('colors.edit');
	Route::post('colors/{colorId}', 'ColorController@update')->name('colors.update');
	Route::get('colors/{colorId}/delete', 'ColorController@destroy')->name('colors.destroy');

	//Sizes
	Route::get('sizes', 'SizeController@index');
	Route::get('sizes/create', 'SizeController@create')->name('sizes.create');
	Route::post('sizes', 'SizeController@store')->name('sizes.store');
	Route::get('sizes/{sizeId}/edit', 'SizeController@edit')->name('sizes.edit');
	Route::post('sizes/{sizeId}', 'SizeController@update')->name('sizes.update');
	Route::get('sizes/{sizeId}/delete', 'SizeController@destroy')->name('sizes.destroy');

	//Clothing types
	Route::get('clothing-types', 'ClothingTypeController@index');
	Route::get('clothing-types/create', 'ClothingTypeController@create')->name('clothing-types.create');
	Route::post('clothing-types', 'ClothingTypeController@store')->name('clothing-types.store');
	Route::get('clothing-types/{clothingTypeId}/edit', 'ClothingTypeController@edit')->name('clothing-types.edit');
	Route::post('clothing-types/{clothingTypeId}', 'ClothingTypeController@update')->name('clothing-types.update');
	Route::get('clothing-types/{clothingTypeId}/delete', 'ClothingTypeController@destroy')->name('clothing-types.destroy');

	//Seasons
	Route::get('seasons', 'SeasonController@index');
	Route::get('seasons/create', 'SeasonController@create')->name('seasons.create');
	Route::post('seasons', 'SeasonController@store')->name('seasons.store');
	Route::get('seasons/{seasonId}/edit', 'SeasonController@edit')->name('seasons.edit');
	Route::post('seasons/{seasonId}', 'SeasonController@update')->name('seasons.update');
	Route::get('seasons/{seasonId}/delete', 'SeasonController@destroy')->name('seasons.destroy');

	//Calendario de ofertas
	Route::get('calendar-sales', 'CalendarSaleController@index');
	Route::get('calendar-sales/create', 'CalendarSaleController@create')->name('calendar-sales.create');
	Route::post('calendar-sales', 'CalendarSaleController@store')->name('calendar-sales.store');
	Route::get('calendar-sales/{calendarSaleId}/edit', 'CalendarSaleController@edit')->name('calendar-sales.edit');
	Route::post('calendar-sales/{calendarSaleId}', 'CalendarSaleController@update')->name('calendar-sales.update');
	Route::get('calendar-sales/{calendarSaleId}/delete', 'CalendarSaleController@destroy')->name('calendar-sales.destroy');
});
