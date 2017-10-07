<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getLogin(){
        return view('front-end.login');
    }

    public function postLogin(){

    }

    public function getSignup(){
        return view('front-end.signup');
    }
    public function postSignup(){

    }

    public function getAccount(){
        return view('front-end.account');
    }
}
