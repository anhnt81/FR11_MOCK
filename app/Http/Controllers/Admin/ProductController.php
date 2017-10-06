<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use File;

class ProductController extends Controller
{
    public function listProduct()
    {
        $products = Product::paginate(5);
        $brands = Brand::all();
        $category = Category::all();

        foreach ($products as $item) {
            $images[$item->id] = explode(',', $item->images);
        }

        return view('back-end.product.index', compact('products', 'brands', 'category', 'images'));
    }

    public function createProduct( Request $req )
    {
        $product = new Product();
        $img = '';
        if ($req->hasFile('image')) {
            $filename = $req->file('image');

            foreach ($filename as $key => $item) {
                $temp = 'p-ava-' . $req->id . $key . '.' . $item->getClientOriginalExtension();
                $item->move('images/front-end/product', $temp);
                $img .= $temp . ',';
            }
        }

        $img = rtrim($img, ',');
        $product->images = $img;
        $product->cid = $req->category;
        $product->bid = $req->brand;
        $product->name = $req->name;
        $product->description = $req->description;
        $product->unit_price = $req->unit_price;
        $product->promotion_price = $req->promotion_price;
        $product->qty = $req->quantity;
        $product->status = $req->status;
        $product->datetime_promotion = $req->datetime_promotion;
        $product->new = $req->new;
        $product->save();

        return redirect('admin/product')->with('message', 'Add Product Success');
    }

    public function updateProduct( $id )
    {
        $catId = Product::find($id)->category->id;
        $brId = Product::find($id)->brand->id;
        $product = Product::where('id', $id)->first();
        $categoryById = Category::where('id', $catId)->first();
        $brandById = Brand::where('id', $brId)->first();
        $categoryAll = Category::all();
        $brandAll = Brand::all();
        $images = explode(',', $product->images);

        return view('back-end.product.edit', compact('product', 'brandAll', 'categoryAll', 'brandById', 'categoryById', 'images'));
    }

    public function saveProduct( $id, Request $request )
    {
        $this->validate($request,
            [
                'name'=> 'required',
                'image[]'=>'nullable|mimes:jpeg,png,jpg',
                'category'=> 'required',
                'description'=> 'required',
                'brand'=> 'required',
                'quantity'=> 'required',
                'unit_price'=> 'required',
                'promotion_price'=> 'required',
            ],
            [
                'name.required' => 'Name is required',
                'image[].required' => 'Image is required',
                'image[].mimes' => 'Image : jpeg, png, jpg',
                'category.required' => 'Category is required',
                'description.required' => 'Description is required',
                'brand.required' => 'Brand is required',
                'quantity.required' => 'Quantity is required',
                'unit_price.required' => 'Unit Price is required',
                'promotion_price.required' => 'Promotion is Price required',
            ]);

        $img = '';
        if ($request->hasFile('image')) {
            $filename = $request->file('image');

            foreach ($filename as $key => $item) {
                $temp = 'p-ava-' . $request->id . $key . '.' . $item->getClientOriginalExtension();
                $item->move('images/front-end/product', $temp);
                $img .= $temp . ',';
            }
        }

        $img = rtrim($img, ',');
        DB::table('tb_product')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'images' => $img,
                'cid' => $request->category,
                'bid' => $request->brand,
                'description' => $request->description,
                'unit_price' => $request->unit_price,
                'promotion_price' => $request->promotion_price,
                'qty' => $request->quantity,
                'status' => $request->status,
                'new' => $request->new
            ]);
        return redirect('admin/product')->with('message', 'Update Product Success');
    }

    public function deleteProduct( $id )
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            $images = Product::where('id', $id)->pluck('images')->toArray();
            File::delete("images/front-end/product/test.jpg");
            if (!empty($images)) {
                $arr_img = explode(',', $images[0]);
                if (count($arr_img) > 1) {
                    foreach ($arr_img as $item) {
                        File::delete("images/front-end/product/$item");
                    }
                } else {
                    File::delete("images/front-end/product/$images[0]");
                }
            }
        }
        return redirect('admin/product')->with('message', 'Delete Product Success');
    }

    public function filterProduct( Request $req )
    {
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
