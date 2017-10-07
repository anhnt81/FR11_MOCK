<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Brand;

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
