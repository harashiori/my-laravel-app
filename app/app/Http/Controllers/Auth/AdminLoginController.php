<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('/auth/login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect('/admin/home');
        }

        return back()->withInput($request->only('email', 'remember'))
                     ->withErrors([
                        'email' => 'メールアドレスが間違っています',
                        'password' => 'パスワードが間違っています', 
                    ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/auth/login');
    }
} 
