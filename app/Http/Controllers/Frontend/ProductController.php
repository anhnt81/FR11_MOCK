<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\Cart;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Helper\Helper;
use App\Http\Requests\admin\UpdateCustomerRequest;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Request;
use Mail;
use function Sodium\compare;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
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
    public function getAddToCart(\Illuminate\Http\Request $r, $id){
        $qty = $r->qty;
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $Cart = new Cart($oldCart);
        $Cart->addCart($product,$id, $qty);
        $r->session()->put('cart',$Cart);

        return view('front-end.cart');
    }

    public function getProductDetail($id){
        $productOld = Product::find($id);
        $views = $productOld->views;
        if($views == null){
            $views = 1;
        }else{
            $views += 1;
        }

        DB::table('tb_product')
            ->where('id', $id)
            ->update([
                'name' => $productOld->name,
                'images' => $productOld->images,
                'cid' => $productOld->cid,
                'bid' => $productOld->bid,
                'description' => $productOld->description,
                'unit_price' => $productOld->unit_price,
                'promotion_price' => $productOld->promotion_price,
                'qty' => $productOld->qty,
                'status' => $productOld->status,
                'new' => $productOld->new,
                'views' => $views,
                'avatar' => $productOld->avatar,
            ]);
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
        $images = explode(',', $product->images);
        return view('front-end.product-detail',compact('product','sp_tuongtu', 'cmt', 'prdSameCat', 'prdSameBr', 'rate','images'));
    }

    public function changeCart(\Illuminate\Http\Request $r, $id, $qty)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $Cart = new Cart($oldCart);
        $Cart->updateCart($id, $qty);
        $r->session()->put('cart',$Cart);

        return 'ok';
    }

    public function deleteCart( $id )
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
            return redirect()->back();
        } else {
            Session::forget('cart');
            return redirect()->back();
        }
    }

    public function deleteAllCart(\Illuminate\Http\Request $r)
    {
        $r->session()->forget('cart');
        return redirect()->back();
    }

    public function getBookCart(){
        return view('front-end.dat-hang');
    }

    public function postOrder(UpdateCustomerRequest $r)
    {
        $cart = Session::get('cart');

        DB::insert("INSERT INTO tb_customer (name, uid, address, phone, email, gender, created_at, updated_at)".
            "VALUES ('{$r->name}', '{$r->uid}', '{$r->address}', '{$r->phone}', '{$r->email}', '{$r->gender}', now(), now())");
        $cid = DB::select('SELECT max(id) as idmax from tb_customer')[0]->idmax;

        DB::insert("INSERT INTO tb_order (cid, total, note, status, created_at, updated_at)".
            "VALUES ('{$cid}', '{$cart->totalPrice}', '{$r->note}', 1, now(), now())");
        $oid = DB::select('SELECT max(id) as idmax from tb_order')[0]->idmax;

        foreach ($cart['items'] as $key => $item) {
            DB::insert("INSERT INTO tb_order_detail (oid, pid, total, qty, created_at, updated_at) ".
                  "VALUES ('$oid', '{$key}', '{$item['price']}', '{$item['qty']}', now(), now())");

            $prd = DB::select('select * from tb_product where id=' . $key);

            DB::update("update tb_product set qty=" . ($prd[0]->qty - $item['price']) ."  where id=" . $key);
        }
        $data = array(
            'name' => $r->input('name'),
            'email' => $r->input('email'),
            'address' => $r->input('address'),
            'gender' => $r->input('gender'),
            'phone' => $r->input('phone'),
            'note' => $r->input('note'),
        );


        Mail::send('front-end.email-order', ['list' => $data], function($message) use ($data)
        {
            $message->from('chipstart1994@gmail.com', 'Send mail Contact');
            $message->to('thuhangitepu@gmail.com', 'Thu Hằng')->subject('Information custom order product web Fresh-Garden');
        });

        $r->session()->forget('cart');
        return redirect()->route('success');
    }

    public function category($id)
    {
        $cat = Category::find($id);
        $listCat = Category::all();

        $listId = Helper::getid($cat, $listCat);

        $listProduct = Product::whereIn('cid', $listId)
            ->orderBy('updated_at', 'desc')
            ->paginate($this->__paginate);
        $listBr = Brand::all();

        return view('front-end.cat-page', compact('listProduct', 'cat', 'listBr'));
    }

    public function filter()
    {
        if(Request::ajax()) {
            $ope = '=';
            if(empty($_POST['brand'])) {
                $ope = '<>';
            }
           $listProduct = Product::where('bid', $ope, $_POST['brand'])
                ->whereBetween('unit_price', [$_POST['from'], $_POST['to']])
                ->orderBy($_POST['sort'], $_POST['type'])
                ->paginate($this->__paginate);

            return view('front-end.list-prd', compact('listProduct'));
        }
    }

    public function getRate($pid)
    {
        $rate['myrate'] = 0;
        $rate['mycmt'] = '';
        if(Auth::check()) {
            $rate['myrate'] = Comment::where('pid', $pid)
                ->where('uid', Auth::user()->id)->get();
            if($rate['myrate']->count() > 0){
                $rate['mycmt'] = $rate['myrate'][0]->content;
                $rate['myrate'] = $rate['myrate'][0]->rate;
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
            $temp = Comment::where('pid', '=', $_POST['pid'])
                ->where('uid', '=', $_POST['uid'])
                ->get();

            if($temp->count() > 0) {
                $thisComment = Comment::find($temp[0]->id);
            }
            else {
                $thisComment = new Comment();
            }

            $thisComment->uid = $_POST['uid'];
            $thisComment->pid = $_POST['pid'];
            $thisComment->rate = $_POST['rate'];
            $thisComment->content = $_POST['content'];
            $thisComment->status = 1;

            $thisComment->save();

            $rate = $this->getRate($_POST['pid']);

            $cmt = Comment::where('pid', $_POST['pid'])->get();

            return view('front-end.cmd-detail', compact('rate', 'cmt'));
        }
    }

    public function getListProduct(){
        $listProduct = Product::orderBy('updated_at')->paginate($this->__paginate);
        $listBr = Brand::all();
        return view('front-end.new-product',compact('listProduct','listBr'));
    }

    public function getSearch(\Illuminate\Http\Request $r){
        $tukhoa = $r->s;
        $data = Product::where('name','like',"%$tukhoa%")->paginate($this->__paginate);
        return view('front-end.search',['product'=>$data]);
    }
}
