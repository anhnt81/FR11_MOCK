<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class HomePageController extends Controller
{
    public function homePage(){
        //DropDownMenu
        $cattegory = Category::with('childHas')->where('parentId',null)->get();
//        foreach ($cat as $item){
//            $item->childHas->count();
//            foreach ($item->childHas as $submenu){
//                print_r($submenu->name);
//            }
//
//        }
        return view('front-end.index',compact('cattegory'));
    }
}
