<?php

namespace App\Http\Controllers\Admin;

use App\Bills;
use App\Http\Controllers\Controller;
use App\Product;
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
        if(Auth::guard('admin')->check()) {
            $orders = $this->getOrder();
            $prd = $this->getProduct();

            return view('back-end.home', compact('orders', 'prd'));
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

        if( Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $request->remember)) {
            if(Auth::guard('admin')->User()->level <= 2){
                if(Auth::guard('admin')->User()->status == 1){
                    return redirect()->route('home');
                }
                else{
                    Auth::guard('admin')->logout();
                    $errors = new MessageBag(['errorlogin' => 'Tài khoản này đang bị khóa']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
            else{
                Auth::guard('admin')->logout();
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
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

    public function getOrder()
    {
        $from = date('Y-m-d');
        $to = strtotime(date("Y-m-d", strtotime($from)) . " +1 days");
        $to = strftime("%Y-%m-%d", $to);

        $fromWeek = strtotime(date("Y-m-d", strtotime($from)) . " -" . (date('w') - 1) . " days");
        $fromWeek = strftime("%Y-%m-%d", $fromWeek);
        $toWeek = strtotime(date("Y-m-d", strtotime($from)) . " +" . (7 - date('w')) . " days");
        $toWeek = strftime("%Y-%m-%d", $toWeek);

        $orders['total'] = Bills::all()->count();
        $orders['day'] = Bills::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->count();
        $orders['week'] = Bills::where('created_at', '>=', $fromWeek)
            ->where('created_at', '<=', $toWeek)
            ->count();
        $orders['close'] = Bills::where('status', '=', '7')->count();
        $orders['pending'] = Bills::where('status', '=', 1)->get()->toArray();

        return $orders;
    }

    public function getProduct()
    {
        $prd = Product::where('qty', '<=', 2)->get()->toArray();

        return $prd;
    }
}
