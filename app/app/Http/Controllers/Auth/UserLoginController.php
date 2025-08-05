<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
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

        if (Auth::guard('user')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect('/home');
        }

        return back()->withInput($request->only('email', 'remember'))
                     ->withErrors([
                        'email' => 'メールアドレスが間違っています',
                        'password' => 'パスワードが間違っています', 
                    ]);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/auth/login');
    }
} 