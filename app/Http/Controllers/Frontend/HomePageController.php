<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Brand;
use Session;

class HomePageController extends Controller
{
    public function homePage(){
        //DropDownMenu
        $newProduct = Product::where('new',1)->paginate(4);
        $listProduct = Product::where('new',0)->paginate(8);

        return view('front-end.index',compact('newProduct','listProduct'));
    }
}
