<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Brand;
use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //share view data category
        view()->composer('front-end.layouts.header',function($view){
            $category = Category::with('childHas')->where('parentId',null)->get();
            $brand = Brand::all();
            $view->with('category',$category);
        });
        //share view data brand
        view()->composer('front-end.layouts.header',function($view){
            $brand = Brand::all();
            $view->with('brand',$brand);
        });

        view()->composer(['front-end.layouts.header','front-end.dat-hang'],function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
