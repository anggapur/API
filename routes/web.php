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
    return view('welcome');
});
Route::get('notValid',function(){
	return view('notValid');
	});
Route::middleware(['cekApiKey'])->group(function(){
	Route::get('products/search/{q}','productCtrl@search');
	Route::resource('products','productCtrl');
	Route::resource('sliders','sliderCtrl');
	Route::resource('categories','categoryCtrl');
	Route::resource('carts','cartCtrl');
	Route::resource('users','userCtrl');
	Route::any('login','userCtrl@login');
});
