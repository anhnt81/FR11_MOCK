<?php

namespace App\Http\Controllers\Frontend;

use App\Slide;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Brand;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\File;


class HomePageController extends Controller
{
    private $__paginate;
    public function __construct()
    {
        if(File::exists('file.txt'))
        {
            $this->__paginate = File::get('file.txt');
        }
        else
        {
            $this->__paginate = 10;
        }
    }
    public function homePage(){
        if(isset($_COOKIE['old'])) {
            $old = true;
        }
        else {
            setcookie('old', 'ok', time() + 84600);
            $old = false;
        }

        //DropDownMenu
        $newProduct = Product::where('new',1)->limit(4)->get();
        $totalNew = count(Product::where('new',1)->get());
//        $bestProduct = Product::leftJoin('tb_order_detail as od', 'tb_product.id', '=', 'od.pid')
//            ->select("tb_product.*", DB::raw('count(od.pid) as o_qty'))
//            ->groupBy('tb_product.id')
//            ->orderBy('o_qty', 'desc')
//            ->get();
        $bestProduct = Product::all();
        $totalBest = count($bestProduct);
        $listBr = Brand::all();
        $slide = Slide::all();

        return view('front-end.index',compact('newProduct','bestProduct', 'slide', 'old', 'listBr','totalNew','totalBest'));
    }
}
