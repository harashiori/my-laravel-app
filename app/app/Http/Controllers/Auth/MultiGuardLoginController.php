<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiGuardLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:user,coach,admin',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        $role = $request->input('role');

        // ガード名とリダイレクト先の
        $guardRedirectMap = [
            'user'  => '/home',
            'coach' => '/coach/home',
            'admin' => '/admin/home',
        ];

        if (Auth::guard($role)->attempt($credentials, $remember)) {
            return redirect()->intended($guardRedirectMap[$role]);
        }

        return back()->withInput($request->only('email', 'role'))
             ->withErrors([
                'login' => 'メールアドレスまたはパスワードが間違っています。',
            ]);
    }

    public function logout(Request $request)
    {
        // すべての guard をログアウト（安全策）
        foreach (['user', 'coach', 'admin'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }
        return redirect('/auth/login');
    }
}

