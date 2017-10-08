<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Session;

class ProductController extends Controller
{
    public function getAddToCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $Cart = new Cart($oldCart);
        $Cart->addCart($product,$id);
        $req->session()->put('cart',$Cart);

        return redirect()->back();
    }

    public function getProductDetail(Request $req,$id){
        $product = Product::find($id);
        $sp_tuongtu = Product::where('cid',$product->cid)->paginate(4);
        return view('front-end.product-detail',compact('product','sp_tuongtu'));
    }

    public function deleteCart(Request $req,$id){}

    public function getBookCart(){
        return view('front-end.dat-hang');
    }
}
