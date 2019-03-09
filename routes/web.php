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

	//Brands
	Route::get('brands', 'BrandController@index');
	Route::get('brands/create', 'BrandController@create')->name('brands.create');
	Route::post('brands', 'BrandController@store')->name('brands.store');
	Route::get('brands/{departmentId}/edit', 'BrandController@edit')->name('brands.edit');
	Route::post('brands/{departmentId}', 'BrandController@update')->name('brands.update');
	Route::get('brands/{departmentId}/delete', 'BrandController@destroy')->name('brands.destroy');

	//Departments
	Route::get('departments', 'DepartmentController@index');
	Route::get('departments/create', 'DepartmentController@create')->name('departments.create');
	Route::post('departments', 'DepartmentController@store')->name('departments.store');
	Route::get('departments/{departmentId}/edit', 'DepartmentController@edit')->name('departments.edit');
	Route::post('departments/{departmentId}', 'DepartmentController@update')->name('departments.update');
	Route::get('departments/{departmentId}/delete', 'DepartmentController@destroy')->name('departments.destroy');
});
