<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GioithieuController extends Controller
{
    public function getGioithieu(){
        return view('front-end.gioi-thieu');
    }
}
