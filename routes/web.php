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
Route::view('/support', 'footer.support');
Route::view('/faq', 'footer.faq');
Route::view('/terms', 'footer.terms');
Route::view('/privacy', 'footer.privacy');
Route::view('/return-policy', 'footer.return-policy');
Route::view('/about', 'footer.about');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {

	Route::get('dashboard', 'DashboardController@index');

	//Route::resource('brands', 'BrandController');

	Route::get('brands', 'BrandController@index');

	Route::get('brands/create', 'BrandController@create')->name('brands.create');
	Route::post('brands', 'BrandController@store')->name('brands.store');

	Route::get('brands/{brandId}/edit', 'BrandController@edit')->name('brands.edit');
	Route::post('brands/{brandId}', 'BrandController@update')->name('brands.update');

	Route::get('brands/{brandId}/delete', 'BrandController@destroy')->name('brands.destroy');
});
