<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    private $__br;
    
    public function __construct()
    {
        $this->__br = new Brand();
    }

    //list function
    public function listBrand()
    {
        $data['per'] = 7;
        $data['key'] = '';
        $data['sort'] = 'id';
        $data['type'] = 'desc';

        if(Request::ajax()) {
            $data['per'] = $_POST['per'];
            $data['key'] = $_POST['search'];
            $data['sort'] = $_POST['sort'];
            $data['type'] = $_POST['type_sort'];
        }

        $list = $this->__br->where('name', 'LIKE', '%' . $data['key'] . '%')
            ->orderBy($data['sort'], $data['type'])
            ->paginate($data['per']);

        $total = $this->__br->where('name', 'LIKE', '%' . $data['key'] . '%')->count();
        $start = $list->perPage() * ($list->currentPage() - 1) + 1;
        $end = $list->perPage() * ($list->currentPage() - 1) + $list->perPage();

        if($end > $total) {
            $end = $total;
        }

        if(Request::ajax()) {
            return view('back-end.Brand.ajax', compact('list', 'start', 'end', 'total', 'data'));
        }
        return view('back-end.Brand.list', compact('list', 'start', 'end', 'total', 'data'));
    }
    //add function
    public function addBrand()
    {
    	return view('back-end.Brand.add');
    }
    public function postBrand(\Illuminate\Http\Request $r){
    	//co ham san de kiem tr du lieu form la validate
    	$this->validate($r,
    		//mang cac loi can bat
    		['namebrand' => 'required|min:2|max:50|unique:tb_brand,name'],
    		//mang thong bao cac loi
    		[
    			'namebrand.required' => 'Please fill namebrand.',
    			'namebrand.min' => 'Namebrand is too short.',
    			'namebrand.max' => 'Namebrand is too long.',
                'namebrand.unique' => 'Namebrand already exists.'
    		]
    		);
    	$br = $this->__br->where('name',$r->namebrand)->get();
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
    	$br = $this->__br->where('id',$id)->first();
    	// foreach ($br as $key=>$value) {
    		
    	// 		echo "<pre>";
    	// 		print_r($value->name);
		   //  	// var_dump($value);
		   //  	echo "</pre>";
    		
    		
    	//  }
    	
    	return view('back-end.Brand.edit',['brand'=>$br]);
    }
    public function postEdit(\Illuminate\Http\Request $r,$id)
    {
    	$this->validate($r,['namebrand' =>'required|min:2|max:50|unique:tb_brand,name'],
    		[
    			'namebrand.required' => 'Please fill namebrand',
    			'namebrand.min' => 'Namebrand is too short',
    			'namebrand.max' => 'Namebrand is too long',
    			'namebrand.unique' => 'Namebrand already exist.',
    		]);
    	$br = $this->__br->where('id',$id)->update(['name'=>$r->namebrand]);

    	return redirect()->back()->with('success','Edit namebrand successfully.');

    }
    //delete function
    public function deleteBrand($id)
    {
    	$de = $this->__br->where('id',$id)->first();

    	return view('back-end.Brand.delete',['d'=>$de]);
    }
    public function postDelete(\Illuminate\Http\Request $r,$id){
    	
    	if(isset($r->agree))
    	{
    		$br = $this->__br->where('id',$id)->delete();
    		return redirect()->route('listBrand')->with('delete','Delete Brand success');
    	}
    	else
    	{
    		return redirect()->route('listBrand');
    	}
    }
}
