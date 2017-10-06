<?php

namespace App\Http\Controllers\Admin;

use App\Bills;
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
            $from = date('Y-m-d');
            $to = strtotime(date("Y-m-d", strtotime($from)) . " +1 days");
            $to = strftime("%Y-%m-%d", $to);

            $fromWeek = strtotime(date("Y-m-d", strtotime($from)) . " -" . (date('w') - 1) . " days");
            $fromWeek = strftime("%Y-%m-%d", $fromWeek);
            $toWeek = strtotime(date("Y-m-d", strtotime($from)) . " +" . (7 - date('w')) . " days");
            $toWeek = strftime("%Y-%m-%d", $toWeek);

            $totalOrder = Bills::all()->count();
            $dayOrder = Bills::where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)
                ->count();
            $weekOrder = Bills::where('created_at', '>=', $fromWeek)
                ->where('created_at', '<=', $toWeek)
                ->count();
            $closeOrder = Bills::where('status', '=', '7')->count();

            return view('back-end.home', compact('totalOrder', 'dayOrder', 'weekOrder','closeOrder'));
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

        if( Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {
            if(Auth::User()->level <= 2){
                if(Auth::User()->status == 1){
                    return redirect()->route('home');
                }
                else{
                    Auth::logout();
                    $errors = new MessageBag(['errorlogin' => 'Tài khoản này đang bị khóa']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
            else{
                Auth::logout();
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
