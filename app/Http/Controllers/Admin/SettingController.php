<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slide;
use App\Category;
use App\Brand;
use App\Product;

class SettingController extends Controller
{
    //list slide
    public function listSlide()
    {
    	$data = Slide::paginate(5);
    	return view('back-end.slide.listSlide',['list'=>$data]);
    }
    public function addSlide()
    {
    	$data = Category::all();
    	$dt = Brand::all();
    	$pr = Product::paginate(5);
    	//var_dump($data);
    	return view('back-end.slide.addSlide',['theloai'=>$data,'list'=>$pr]);
    }
    public function ajaxSlide($id)
    {
    	$list = Product::where('cid',$id)->get();
    	echo "<table class='table table-hover table-striped'>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Mô Tả</th>
                        <th>Thêm Làm Slide</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if(count($list) < 1)
                        echo "<tr>
                            <td colspan='5'>Chưa có dữ liệu</td>
                        </tr>";
                    else
                        foreach($list as $row)
                            $img =explode(',', $row->images)[0];
                            echo "<tr>
                                <td>".$row->id."</td>
                                <td>".$row->name."</td>
                                <td><img src='images/front-end/product/$img'  class='img-thumbnail' style='max-height: 150px;'/></td>
                                <td>".$row->description."</td>
                                <td><a href='insertSlide/$row->id' class='btn btn-primary'>Thêm</a></td>
                            </tr>";
        echo "      </tbody>
                </table>";
    }
    public function insertSlide($id)
    {
    	$stt = Slide::count();
    	
    	$slide = new Slide;
    	$slide->pid = $id;
    	$slide->ordinal = ++$stt;
    	$slide->save();
    	
    	return redirect()->back()->with('slide','Thêm thành công.');
    	
    }

    public function deleteSlide(Request $r)
    {
    	$stt = Slide::find($r->id);
    	Slide::destroy($r->id);
    	$data = Slide::where('id','>',$stt->id)->get();
    	foreach ($data as $value) {
    		Slide::where('id',$value->id)->update(['ordinal'=>--$value->ordinal]);
    	}
    	return redirect()->back()->with('deSlide','Xóa Thành Công.');
    }

    public function swapSlide(Request $r)
    {
    	$this->validate($r,['swap' => 'required|exists:tb_slide,ordinal'],
    		[
    			'swap.required' => 'Bạn Chưa Nhập Thứ Tự.',
    			'swap.exists' => 'Bạn Phải Nhập Đúng Thứ Tự cần Đổi.',
    		]);
    	$tg = Slide::where('ordinal',$r->stt)->first();
    	// var_dump($tg->id);
    	Slide::where('ordinal',$r->swap)->update(['ordinal'=>$r->stt]);
    	Slide::where('id',$tg->id)->update(['ordinal'=>$r->swap]);
    	return redirect()->back()->with('swap','Đổi Thành Công.');
    }
    public function setting()
    {
        if(File::exists('file.txt')){
            $pa = File::get('file.txt');
            // echo $pa;
        }
        else{
            $pa = "Chưa Thiết Lập";
        }
        return view('back-end.config',['pa'=>$pa]);
    }
    public function postSetting(Request $r)
    {
        $this->validate($r,['paginate'=>'required|numeric'],
            [
                'paginate.required' => 'Bạn chưa nhập dữ liệu',
                'paginate.numeric' => 'Dữ liệu phải là số'
            ]);
        File::put('file.txt',$r->paginate);
        if(File::exists('file.txt')){
            $pa = File::get('file.txt');
            //echo $pa;
        }
        else{
            $pa = "Chưa Thiết Lập";
        }
        return redirect()->back()->with('success_paginate','Thiết lập thành công')->with('pa',$pa);
    }
}
