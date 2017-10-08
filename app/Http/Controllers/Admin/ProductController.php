<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Request;
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
        $data['per'] = 5;
        $data['key'] = '';
        $data['field'] = 'name';
        $data['sort'] = 'id';
        $data['type'] = 'desc';

        if (Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['field'] = $_POST['field_search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
        }

        $products = Product::where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

        $total = Product::where($data['field'], 'LIKE', '%' . $data['key'] . '%')
            ->count();

        $start = $products->perPage() * ($products->currentPage() - 1) + 1;
        $end = $products->perPage() * ($products->currentPage() - 1) + $products->perPage();

        if ($end > $total) {
            $end = $total;
        }
        foreach ($products as $item) {
            $images[$item->id] = explode(',', $item->images);
        }
        $brands = Brand::all();
        $category = Category::all();

        if (Request::ajax()) {
            return view('back-end.product.list', compact('products', 'start', 'end', 'total', 'brands', 'category', 'images'));
        }

        return view('back-end.product.index', compact('products', 'brands', 'category', 'images', 'start', 'end', 'total', 'data'));
    }

    public function createProduct( \Illuminate\Http\Request $req )
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

    public function saveProduct( $id, \Illuminate\Http\Request $request )
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

        $prd = Product::find($id);

        if($prd->images != ''){
            $img = $prd->images . ',';
            $c = count(explode(',', $prd->images));
        }
        else {
            $img = '';
            $c = 0;
        }
        if ($request->hasFile('image')) {
            $filename = $request->file('image');

            foreach ($filename as $item) {
                $temp = 'p-ava-' . $request->id . $c++ . '.' . $item->getClientOriginalExtension();
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

    public function deleteImg()
    {
        if(Request::ajax()) {
            $pid = Request::get('pid');
            $img = Request::get('image');

            $prd = Product::find($pid);

            $img = str_replace($img, '', $prd->images);
            $img = trim($img, ',');

            $prd->images = $img;

            $prd->save();

            return 'ok';
        }
        return false;
    }
}
