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

// Controllers Within The "App\Http\Controllers\Admin" Admin
Route::group(['prefix'=>'admin'], function() {
    //return view home admin
    Route::get('/', ['as'=>'home','uses'=>'Admin\LoginController@home']);
    //return view form login
    Route::get('/login',['as'=>'getLogin','uses'=>'Admin\LoginController@getLogin']);
    Route::post('/login',['as'=>'postLogin','uses'=>'Admin\LoginController@postLogin']);
    //handle logout
    Route::get('/logout', ['as'=>'logout','uses'=>'Admin\LoginController@logout']);
    //Todo new Route
});