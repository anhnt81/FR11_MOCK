<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public function listProduct(){
        $products = Product::all();
        return view('back-end.product.list-product')->with('products',$products);
    }
}
