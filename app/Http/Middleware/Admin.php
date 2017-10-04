<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::check()) {
            if(Auth::user()->status != 1 || Auth::user()->level > 2) {
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
