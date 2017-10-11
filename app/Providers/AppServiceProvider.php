<?php

namespace App\Providers;

use App\Http\Helper\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Product;
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
            $listId = array();
            $allCat = Category::all();
            for ($i = 0; $i < count($allCat); $i++) {
                $listId = Helper::getid($allCat[$i], $allCat);
                $allCat[$i]->totalPrd = Product::whereIn('cid', $listId)->count();
            }
            //$category = Category::with('childHas')->where('parentId',null)->get();

            $view->with('allCat',$allCat);
        });

        view()->composer(['front-end.layouts.header','front-end.dat-hang', 'front-end.cart'],function($view){
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
