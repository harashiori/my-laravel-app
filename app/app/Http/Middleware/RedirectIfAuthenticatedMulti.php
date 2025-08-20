<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedMulti
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
        
        //すでにログインしている場合
        if (Auth::guard('user')->check()) {
            return redirect()->route('home');
        }

        if (Auth::guard('coach')->check()) {
            return redirect()->route('coach.home');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }

        //ログインしていない場合はそのまま進む（ログイン画面へ）
        return $next($request);
    }
}
