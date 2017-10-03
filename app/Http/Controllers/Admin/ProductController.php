<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function listProduct(){
        $products = Product::paginate(10);
        $brands = Brand::all();
        $category = Category::all();

        return view('back-end.product.index',compact('products','brands','category'));
    }

    public function createProduct(Request $req){
        $product = new Product();
        $filename = $req->file('image')->getClientOriginalName();
        $product->images = $filename;
        $product->cid = $req->category;
        $product->bid = $req->brand;
        $product->name = $req->name;
        $product->description = $req->description;
        $product->unit_price  = $req->unit_price;
        $product->promotion_price = $req->promotion_price;
        $product->qty = $req->quantity;
        $product->save();

        return redirect()->back()->with('message','Add Product Success');
    }

    public function updateProduct($id){
        $brandById = DB::table('tb_brand')->where('id', $id)->first();
        $brandByIds = json_decode(json_encode($brandById),true);
        $brands = DB::table('tb_brand')->first();
        $category = DB::table('tb_category')->first();
        $categoryById = DB::table('tb_category')->where('id', $id)->first();
        $categoryByIds = json_decode(json_encode($categoryById),true);
        $product = DB::table('tb_product')->where('id', $id)->first();

        return view('back-end.product.edit',compact('product','brands','category','brandByIds','categoryByIds'));
    }

    public function saveProduct($id,Request $request){
        $product = new Product();
        $filename = $request->file('image')->getClientOriginalName();

        DB::table('tb_product')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'images' => $filename,
                'cid' => $request->category,
                'bid' => $request->brand,
                'description' => $request->description,
                'unit_price'  => $request->unit_price,
                'promotion_price' => $request->promotion_price,
                'qty' => $request->quantity
            ]);

        return redirect('admin/list-product')->with('message','Update Product Success');
    }
}
