<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\admin\AddUserRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('front-end.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {

            if (Auth::User()->status == 1) {
                return redirect()->route('homePage');
            } else {
                Auth::logout();
                $errors = new MessageBag(['errorlogin' => 'Tài khoản này đang bị khóa']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        } else {
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function getSignup()
    {
        return view('front-end.signup');
    }

    public function postSignup(AddUserRequest $r)
    {
        $user = new User();
        $user->email = $r->email;
        $user->avatar = 'avatar.png';
        $user->password = bcrypt($r->password);
        $user->status = 1;
        $user->phone = $r->phone;
        $user->level = 4;

        if(empty($r->name)){
            $user->name = 'NONAME';
        }
        else{
            $user->name = $r->name;
        }

        $user->save();

        Auth::attempt(['email' => $r->email, 'password' => $r->password]);

        return redirect()->route('success');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->forget('cart');

        return redirect()->route('homePage');
    }

    public function getAccount()
    {
        $user = User::find(Auth::user()->id);

        return view('front-end.account', compact('user'));
    }

    public function success()
    {
        return view('front-end.success');
    }
}
