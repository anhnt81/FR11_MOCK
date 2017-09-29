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
Route::get('admin/login',['as'=>'getLogin','uses'=>'Admin\LoginController@getLogin']);
Route::post('admin/login',['as'=>'postLogin','uses'=>'Admin\LoginController@postLogin']);

Route::get('/admin/home', ['as'=> 'admin', function () {
    return view('back-end.layouts.master');
}]);