<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public function getAddToCart($id){
        $product = Product::find($id);
    }

    public function getProductDetail($id){
        $product = Product::find($id);
    }
}
