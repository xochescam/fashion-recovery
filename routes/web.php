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
	Route::get('brands', 'BrandController@index');
	Route::get('brands/create', 'BrandController@create')->name('brands.create');
	Route::post('brands', 'BrandController@store')->name('brands.store');
	Route::get('brands/{brandId}/edit', 'BrandController@edit')->name('brands.edit');
	Route::post('brands/{brandId}', 'BrandController@update')->name('brands.update');
	Route::get('brands/{brandId}/delete', 'BrandController@destroy')->name('brands.destroy');

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
});
