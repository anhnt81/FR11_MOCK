<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\admin\AddUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('front-end.login');
    }

    public function postLogin(Request $request)
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

        return redirect()->route('success')->with('success', 'Thêm thành công!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('homePage');
    }

    public function getAccount()
    {
        return view('front-end.account');
    }

    public function success()
    {
        return view('front-end.success');
    }
}
