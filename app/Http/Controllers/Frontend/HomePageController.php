<?php

namespace App\Http\Controllers\Frontend;

use App\Slide;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Brand;
use Session;

class HomePageController extends Controller
{
    public function homePage(){
        if(isset($_COOKIE['old'])) {
            $old = true;
        }
        else {
            setcookie('old', 'ok', time() + 84600);
            $old = false;
        }

        //DropDownMenu
        $newProduct = Product::where('new',1)->paginate(4);
        $listProduct = Product::where('new',0)->paginate(8);
        $listBr = Brand::all();
        $slide = Slide::all();

        return view('front-end.index',compact('newProduct','listProduct', 'slide', 'old', 'listBr'));
    }
}
