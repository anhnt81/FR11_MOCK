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
        $products = Product::paginate(5);
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
        $product->status = 1;
        $product->save();

        return redirect()->back()->with('message','Add Product Success');
    }

    public function updateProduct($id){
        $catId = Product::find($id)->category->id;
        $brId = Product::find($id)->brand->id;
        $product = Product::where('id', $id)->first();
        $categoryById = Category::where('id', $catId)->first();
        $brandById = Brand::where('id', $brId)->first();
        $categoryAll = Category::all();
        $brandAll = Brand::all();
        return view('back-end.product.edit',compact('product','brandAll','categoryAll','brandById','categoryById'));
    }

    public function saveProduct($id,Request $request){
        $this->validate($request,
            [
                'name'=> 'required',
                'image'=>'required|image|max:2048',
                'category'=> 'required',
                'description'=> 'required',
                'brand'=> 'required',
                'quantity'=> 'required',
                'unit_price'=> 'required',
                'promotion_price'=> 'required',
            ],
            [
                'name.required' => 'Name required',
                'image.required' => 'Image required',
                'category.required' => 'Category required',
                'description.required' => 'Description is required',
                'brand.required' => 'Brand required',
                'quantity.required' => 'Quantity required',
                'unit_price.required' => 'Unit Price required',
                'promotion_price.required' => 'Promotion Price required',
            ]);

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
                'qty' => $request->quantity,
                'status' => 1
            ]);
        return redirect('admin/list-product')->with('message','Update Product Success');
    }

    public function deleteProduct($id){
        Product::where('id',$id)->delete();
        return redirect('admin/list-product')->with('message','Delete Product Success');
    }

    public function filterProduct(Request $req){
        $data['key'] = $req->search;
        $data['field'] = $req->field_search;
        $data['sort'] = $req->sort;
        $data['type'] = $req->type_sort;
        $products = Product::where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->orderBy($data['sort'], $data['type'])
            ->paginate(5)
            ->withPath("?search={$data['key']}&field_search={$data['field']}&sort={$data['sort']}&type_sort={$data['type']}");
        return view('back-end.product.index', compact('products'))->with('data', $data);
    }
}
