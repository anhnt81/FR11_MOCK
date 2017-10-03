<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\MessageBag;
use Validator;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function home()
    {
        if(Auth::check()) {
            return view('back-end.home') ;
        }
        else{
            return redirect()->route('login');
        }
    }
    public function getLogin(){
        return view('back-end.auth.login');
    }

    public function postLogin(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;

        if( Auth::attempt(['email' => $email, 'password' => $password])) {
            if(Auth::User()->level < 2){
                if(Auth::User()->status == 1){
                    return redirect()->route('home');
                }
                else{
                    $errors = new MessageBag(['errorlogin' => 'Tài khoản này đang bị khóa']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
            else{
                $errors = new MessageBag(['errorlogin' => 'Tài khoản này không đủ quyền quản trị']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
        else {
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
