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
    Route::get('dang-nhap',['as'=>'getLogin','uses'=>'Admin\LoginController@getLogin']);
    Route::post('dang-nhap',['as'=>'postLogin','uses'=>'Admin\LoginController@postLogin']);
    //handle logout
    Route::get('dang-xuat', ['as'=>'logout','uses'=>'Admin\LoginController@logout']);
    //Todo new Route

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', array(
            'as' => 'listCus',
            'uses' => 'Admin\CustomerController@index'
        ));
        Route::get('filter', array(
            'as' => 'filterCus',
            'uses' => 'Admin\CustomerController@filter'
        ));
        Route::get('sua-thong-tin/{id}', array(
            'as' => 'upCus',
            'uses' => 'Admin\CustomerController@update'
        ));
        Route::post('sua-thong-tin/{id}', array(
            'as' => 'postUpCus',
            'uses' => 'Admin\CustomerController@postUpdate'
        ));
    });
});