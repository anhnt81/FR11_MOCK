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
// Controllers Within The "App\Http\Controllers\Admin" Admin
Route::group(['prefix'=>'admin'], function() {
    //return view home admin
    Route::get('/', ['as'=>'home','uses'=>'Admin\LoginController@home']);
    //return view form login
    Route::get('dang-nhap',['as'=>'login','uses'=>'Admin\LoginController@getLogin']);
    Route::post('dang-nhap',['as'=>'postLogin','uses'=>'Admin\LoginController@postLogin']);
    //handle logout
    Route::get('dang-xuat', ['as'=>'logout','uses'=>'Admin\LoginController@logout']);
    //Todo new Route

    //customer route
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


    //category route
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', array(
            'as' => 'listCat',
            'uses' => 'Admin\CategoryController@index'
        ));

        Route::get('filter', array(
            'as' => 'filterCat',
            'uses' => 'Admin\CategoryController@filter'
        ));

        Route::get('them-moi', array(
            'as' => 'addCat',
            'uses' => 'Admin\CategoryController@add'
        ));
        Route::post('them-moi', array(
            'as' => 'postAddCat',
            'uses' => 'Admin\CategoryController@postAdd'
        ));

        Route::get('sua-thong-tin/{id}', array(
            'as' => 'upCat',
            'uses' => 'Admin\CategoryController@update'
        ));
        Route::post('sua-thong-tin/{id}', array(
            'as' => 'postUpCat',
            'uses' => 'Admin\CategoryController@postUpdate'
        ));

        Route::get('xoa/{id}', array(
            'as' => 'delCat',
            'uses' => 'Admin\CategoryController@delete'
        ));
    });

    //order route
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', array(
            'as' => 'listOrder',
            'uses' => 'Admin\OrderController@index'
        ));

        Route::get('filter', array(
            'as' => 'filterOrder',
            'uses' => 'Admin\OrderController@filter'
        ));

        Route::get('chi-tiet/{id}', array(
            'as' => 'orderDetail',
            'uses' => 'Admin\OrderController@viewDetail'
        ));

        Route::get('sua-thong-tin/{id}', array(
            'uses' => 'Admin\OrderController@update'
        ));
        Route::post('sua-thong-tin/{id}', array(
            'uses' => 'Admin\OrderController@postUpdate'
        ));
    });

    //comment route
    Route::group(['prefix' => 'comment'], function () {
        Route::get('/', array(
            'as' => 'listCmt',
            'uses' => 'Admin\CmtController@index'
        ));

        Route::get('sua-thong-tin/{id}', ['uses' => 'Admin\CmtController@changeStatus']);
        Route::get('filter', ['uses' => 'Admin\CmtController@filter']);
    });
});