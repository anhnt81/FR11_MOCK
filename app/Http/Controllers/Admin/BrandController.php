<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    //list function
    public function listBrand()
    {
    	$data = Brand::paginate(5);
    	// var_dump($data);
    	return view('back-end.Brand.list',['list'=>$data]);
    }
    //add function
    public function addBrand()
    {
    	return view('back-end.Brand.add');
    }
    public function postBrand(Request $r){
    	//co ham san de kiem tr du lieu form la validate
    	$this->validate($r,
    		//mang cac loi can bat
    		['namebrand' => 'required|min:2|max:50'],
    		//mang thong bao cac loi
    		[
    			'namebrand.required' => 'Please fill namebrand.',
    			'namebrand.min' => 'Namebrand is too short.',
    			'namebrand.max' => 'Namebrand is too long.',
    		]
    		);
    	$br = Brand::where('name',$r->namebrand)->get();
    	// echo $br;
    	// echo "<pre>";
    	// print_r($br)
    	// echo "</pre>";
    	if($br == "[]"){
    		$brand = new Brand;
	    	$brand->name = $r->namebrand;
	    	$brand ->save();

	    	return redirect()->route('addBrand')->with('success','ADD namebrand suscessfully.');
    	}
    	else
    	{
    		return redirect()->route('addBrand')->with('duplicate','Namebrand already exist.');
    	}

    }
    //edit function
    public function editBrand($id)
    {
    	$br = Brand::where('id',$id)->first();
    	// foreach ($br as $key=>$value) {
    		
    	// 		echo "<pre>";
    	// 		print_r($value->name);
		   //  	// var_dump($value);
		   //  	echo "</pre>";
    		
    		
    	//  }
    	
    	return view('back-end.Brand.edit',['brand'=>$br]);
    }
    public function postEdit(Request $r,$id)
    {
    	$this->validate($r,['namebrand' =>'required|min:2|max:50|unique:tb_brand,name'],
    		[
    			'namebrand.required' => 'Please fill namebrand',
    			'namebrand.min' => 'Namebrand is too short',
    			'namebrand.max' => 'Namebrand is too long',
    			'namebrand.unique' => 'Namebrand already exist.',
    		]);
    	$br = Brand::where('id',$id)->update(['name'=>$r->namebrand]);

    	return redirect()->back()->with('success','Edit namebrand successfully.');

    }
    //delete function
    public function deleteBrand($id)
    {
    	$de = Brand::where('id',$id)->first();

    	return view('back-end.Brand.delete',['d'=>$de]);
    }
    public function postDelete(Request $r,$id){
    	
    	if(isset($r->agree))
    	{
    		$br = Brand::where('id',$id)->delete();
    		return redirect()->route('listBrand')->with('delete','Delete Brand success');
    	}
    	else
    	{
    		return redirect()->route('listBrand');
    	}
    }
}
