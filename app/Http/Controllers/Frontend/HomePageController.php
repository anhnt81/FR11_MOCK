<?php

namespace App\Http\Controllers\Frontend;

use App\Slide;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Brand;
use Illuminate\Support\Facades\DB;
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
        $newProduct = Product::where('new',1)->limit(8)->get();
        $bestProduct = Product::leftJoin('tb_order_detail as od', 'tb_product.id', '=', 'od.pid')
            ->select('tb_product.*', DB::raw('count(od.pid) as o_qty'))
            ->groupBy('tb_product.id')
            ->orderBy('o_qty', 'desc')
            ->limit(8)->get();
        $listBr = Brand::all();
        $slide = Slide::orderBy('ordinal')->get();

        return view('front-end.index',compact('newProduct','bestProduct', 'slide', 'old', 'listBr'));
    }
}
