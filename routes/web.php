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
//Route::get('/', ['as' => 'fr-homePage', 'uses' => 'Frontend\HomePageController@homePage']);
// Controllers Within The "App\Http\Controllers\Admin" Admin
Route::get('admin/dang-nhap', ['as' => 'login', 'uses' => 'Admin\LoginController@getLogin']);
Route::post('admin/dang-nhap', ['as' => 'postLogin', 'uses' => 'Admin\LoginController@postLogin']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    //return view home admin
    Route::get('/', ['as' => 'home', 'uses' => 'Admin\LoginController@home']);
    //return view form login

    //handle logout
    Route::get('dang-xuat', ['as' => 'logout', 'uses' => 'Admin\LoginController@logout']);
    //Todo new Route
    //Hien: Brand
    Route::group(['prefix' => '/brand'], function () {
        Route::get('/', ['as' => 'listBrand', 'uses' => 'Admin\BrandController@listBrand']);
    });

    //customer route
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', array(
            'as'   => 'listCus',
            'uses' => 'Admin\CustomerController@index'
        ));
        Route::post('/', array(
            'as'   => 'ajaxCus',
            'uses' => 'Admin\CustomerController@index'
        ));
//        Route::get('filter', array(
//            'as'   => 'filterCus',
//            'uses' => 'Admin\CustomerController@filter'
//        ));
        Route::get('sua-thong-tin/{id}', array(
            'as'   => 'upCus',
            'uses' => 'Admin\CustomerController@update'
        ));
        Route::post('sua-thong-tin/{id}', array(
            'as'   => 'postUpCus',
            'uses' => 'Admin\CustomerController@postUpdate'
        ));
    });
    /* AnhNT9 listView Product */
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', ['as' => 'listProduct', 'uses' => 'Admin\ProductController@listProduct']);
        Route::post('/', array(
            'as'   => 'ajaxPrd',
            'uses' => 'Admin\ProductController@listProduct'
        ));
        Route::get('del-img', ['uses' => 'Admin\ProductController@deleteImg']);
        Route::post('/add', ['as' => 'addProduct', 'uses' => 'Admin\ProductController@createProduct']);
        Route::get('filter', ['as' => 'filterProduct', 'uses' => 'Admin\ProductController@filterProduct']);
        Route::get('edit/{id}', ['as' => 'updateProduct', 'uses' => 'Admin\ProductController@updateProduct'])->where('id', '[0-9]+');
        Route::post('edit/{id}', ['as' => 'saveProduct', 'uses' => 'Admin\ProductController@saveProduct'])->where('id', '[0-9]+');
        Route::post('del/{id}', ['as' => 'deleteProduct', 'uses' => 'Admin\ProductController@deleteProduct'])->where('id', '[0-9]+');
    });

    //category route
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', array(
            'as'   => 'listCat',
            'uses' => 'Admin\CategoryController@index'
        ));

        Route::post('/', array(
            'as'   => 'ajaxCat',
            'uses' => 'Admin\CategoryController@index'
        ));

//        Route::get('filter', array(
//            'as'   => 'filterCat',
//            'uses' => 'Admin\CategoryController@filter'
//        ));

        Route::get('them-moi', array(
            'as'   => 'addCat',
            'uses' => 'Admin\CategoryController@add'
        ));
        Route::post('them-moi', array(
            'as'   => 'postAddCat',
            'uses' => 'Admin\CategoryController@postAdd'
        ));

        Route::get('sua-thong-tin/{id}', array(
            'as'   => 'upCat',
            'uses' => 'Admin\CategoryController@update'
        ));
        Route::post('sua-thong-tin/{id}', array(
            'as'   => 'postUpCat',
            'uses' => 'Admin\CategoryController@postUpdate'
        ));

        Route::post('xoa', array(
            'as'   => 'delCat',
            'uses' => 'Admin\CategoryController@delete'
        ));
    });
    //order route
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', array(
            'as'   => 'listOrder',
            'uses' => 'Admin\OrderController@index'
        ));

        Route::post('/', array(
            'as'   => 'ajaxOrder',
            'uses' => 'Admin\OrderController@index'
        ));

//        Route::get('filter', array(
//            'as'   => 'filterOrder',
//            'uses' => 'Admin\OrderController@filter'
//        ));

        Route::get('chi-tiet/{id}', array(
            'as'   => 'orderDetail',
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
            'as'   => 'listCmt',
            'uses' => 'Admin\CmtController@index'
        ));

        Route::post('/', array(
            'as'   => 'ajaxCmt',
            'uses' => 'Admin\CmtController@index'
        ));

        Route::get('sua-thong-tin/{id}', array(
            'uses' => 'Admin\CmtController@changeStatus'
        ));
    });

    //users route
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', array(
            'as'   => 'listUser',
            'uses' => 'Admin\UserController@index'
        ));

        Route::post('/', array(
            'as'   => 'ajaxUser',
            'uses' => 'Admin\UserController@index'
        ));

//        Route::get('filter', array(
//            'as'   => 'filterUser',
//            'uses' => 'Admin\UserController@filter'
//        ));

        Route::get('them-moi', array(
            'as'   => 'addUser',
            'uses' => 'Admin\UserController@add'
        ));
        Route::post('them-moi', array(
            'as'   => 'postAddUser',
            'uses' => 'Admin\UserController@postAdd'
        ));

        Route::get('sua-thong-tin/{id}', array(
            'as'   => 'upUser',
            'uses' => 'Admin\UserController@update'
        ));
        Route::post('sua-thong-tin/{id}', array(
            'as'   => 'postUpUser',
            'uses' => 'Admin\UserController@postUpdate'
        ));

        Route::post('xoa', array(
            'as'   => 'delUser',
            'uses' => 'Admin\UserController@delete'
        ));
    });
    ///SLideeeee Hien
    Route::group(['prefix' => 'slide'], function () {
        Route::get('/', 'Admin\SettingController@listSlide');
        Route::get('addSlide', 'Admin\SettingController@addSlide');
        Route::get('insertSlide/{id}', 'Admin\SettingController@insertSlide');
        Route::post('deleteSlide', 'Admin\SettingController@deleteSlide');
        Route::get('ajaxSlide/{id}', 'Admin\SettingController@ajaxSlide')->name('ajaxSlide');
        Route::post('swapSlide', 'Admin\SettingController@swapSlide');
    });
    //Brand Hien
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'Admin\BrandController@listBrand')->name('listBrand');
        Route::post('/', array(
            'as'   => 'ajaxBrand',
            'uses' => 'Admin\BrandController@listBrand'
        ));
        Route::get('addBrand', 'Admin\BrandController@addBrand')->name('addBrand');
        Route::post('addBrand', 'Admin\BrandController@postBrand')->name('postBrand');
        Route::get('editBrand/{id}', 'Admin\BrandController@editBrand')->name('editBrand');
        Route::post('editBrand/{id}', 'Admin\BrandController@postEdit')->name('postEdit');
        Route::get('deleteBrand/{id}', 'Admin\BrandController@deleteBrand');
        Route::post('deleteBrand/{id}', 'Admin\BrandController@postDelete')->name('postDelete');
    });

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', ['uses' => 'Admin\ReportsController@index']);
        Route::post('/', ['uses' => 'Admin\ReportsController@getByPeriod']);
    });

    Route::get('date', ['uses' => 'Admin\OrderController@getWeekOrder']);
});

// Controllers Within The "App\Http\Controllers\Front-End"

Route::get('/', ['as' => 'homePage', 'uses' => 'Frontend\HomePageController@homePage']);

Route::get('/contact', ['as' => 'contact', 'uses' => 'Frontend\ContactController@getContact']);

Route::get('/gioi-thieu', ['as' => 'gioi-thieu', 'uses' => 'Frontend\GioithieuController@getGioithieu']);

Route::get('dang-nhap', ['as' => 'dang-nhap', 'uses' => 'Frontend\AuthController@getLogin']);

Route::post('dang-nhap', ['as' => 'postLogin', 'uses' => 'Frontend\AuthController@postLogin']);

Route::get('dang-ky', ['as' => 'dang-ky', 'uses' => 'Frontend\AuthController@getSignup']);
Route::post('dang-ky', ['as' => 'post-Signup', 'uses' => 'Frontend\AuthController@postSignup']);

Route::get('sua-thong-tin', ['as' => 'account', 'uses' => 'Frontend\AuthController@getAccount']);

Route::get('add-to-cart/{id}', ['as' => 'AddToCart', 'uses' => 'Frontend\ProductController@getAddToCart']);

Route::get('product-detail/{id}', ['as' => 'DetailProduct', 'uses' => 'Frontend\ProductController@getProductDetail']);

Route::get('xoa-gio-hang/{id}', ['as' => 'xoa-gio-hang', 'uses' => 'Frontend\ProductController@deleteCart']);
Route::get('dat-hang', ['as' => 'dat-hang', 'uses' => 'Frontend\ProductController@getBookCart']);

Route::post('addcmt', ['uses' => 'Frontend\ProductController@addComment']);

Route::get('cam-on', ['as' => 'success', 'uses' => 'Frontend\AuthController@success']);

Route::get('dang-xuat', ['as' => 'logout', 'uses' => 'Frontend\AuthController@logout']);

Route::get('san-pham-moi', ['as' => 'new-prd', 'uses' => 'Frontend\ProductController@new']);

Route::get('san-pham-mua-nhieu', ['as' => 'best-prd', 'uses' => 'Frontend\ProductController@best']);

Route::post('filter', ['uses' => 'Frontend\ProductController@ajax']);

Route::get('chuyen-muc/{id}', ['as' => 'cat-page', 'uses' => 'Frontend\ProductController@category']);

Route::get('search',['as'=>'search','uses'=>'Frontend\ProductController@getSearch']);
