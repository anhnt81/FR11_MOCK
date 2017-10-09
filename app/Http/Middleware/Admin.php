<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin')->check()) {
            if(Auth::guard('admin')->User()->status != 1 || Auth::guard('admin')->User()->level > 2) {
                return redirect('admin/dang-nhap');
            }
            else {
                return $next($request);
            }
        }
        else {
            return redirect('admin/dang-nhap');
        }
    }
}
