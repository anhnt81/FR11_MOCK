<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Cart;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductController extends Controller
{
    public function getAddToCart(Request $req,$id){
            $product = Product::find($id);
            $oldCart = Session('cart') ? Session::get('cart') : null;
            $Cart = new Cart($oldCart);
            $Cart->addCart($product,$id);
            $req->session()->put('cart',$Cart);
            $data = $req->session()->get('cart');
        return redirect()->back();
    }

    public function getProductDetail(Request $req,$id){
        $product = Product::find($id);
        $cmt = Comment::where('pid', $product->id)->get();
        $prdSameCat = Product::where('cid', $product->cid)
            ->orderBy('updated_at', 'desc')
            ->limit(5)->get();
        $prdSameBr = Product::where('bid', $product->bid)
            ->orderBy('updated_at', 'desc')
            ->limit(5)->get();
        $sp_tuongtu = Product::where('cid',$product->cid)->limit(3)->get();
        $rate = $this->getRate($product->id);

        return view('front-end.product-detail',compact('product','sp_tuongtu', 'cmt', 'prdSameCat', 'prdSameBr', 'rate'));
    }

    public function deleteCart($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart',$cart);
            return redirect()->back();
        } else {
            Session::forget('cart');
            return redirect()->back();
        }
    }

    public function getBookCart(){
        return view('front-end.dat-hang');
    }

    public function getRate($pid)
    {
        $rate['myrate'] = 0;
        if(Auth::check()) {
            $rate['myrate'] = Comment::where('pid', $pid)
                ->where('uid', Auth::user()->id)->get();
            if($rate['myrate']->count() > 0){
                $rate['myrate'] = $rate['myrate']->rate;
            }
        }
        $rate['avg'] = Comment::where('pid', $pid);
        if($rate['avg']->count() > 0) {
            $rate['avg'] = $rate['avg']->avg('rate');
        }
        else {
            $rate['avg'] = 0;
        }
        $rate['avg'] = round($rate['avg'], 1);

        $rate['five'] = Comment::where('pid', $pid)
            ->where('rate', '=', 5)->count();
        $rate['four'] = Comment::where('pid', $pid)
            ->where('rate', '=', 4)->count();
        $rate['three'] = Comment::where('pid', $pid)
            ->where('rate', '=', 3)->count();
        $rate['two'] = Comment::where('pid', $pid)
            ->where('rate', '=', 2)->count();
        $rate['one'] = Comment::where('pid', $pid)
            ->where('rate', '=', 1)->count();

        return $rate;
    }

    public function addComment()
    {
        if(Request::ajax()) {
            $cmt = new Comment();

            $cmt->uid = $_POST['uid'];
            $cmt->pid = $_POST['pid'];
            $cmt->rate = $_POST['rate'];
            $cmt->content = $_POST['content'];
            $cmt->status = 1;

            $cmt->save();

            $rate = $this->getRate($_POST['pid']);

            return view('front-end.cmd-detail', compact('rate'));
        }
    }
}
