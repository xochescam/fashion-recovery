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

Route::get('dashboard', 'DashboardController@index');