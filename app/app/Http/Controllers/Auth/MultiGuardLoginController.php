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

    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         'email'    => 'required|email',
    //         'password' => 'required',
    //         'role'     => 'required|in:user,coach,admin',
    //     ]);

    //     $credentials = $request->only('email', 'password');
    //     $remember = $request->filled('remember');
    //     $role = $request->input('role');

    //     // ガード名とリダイレクト先
    //     $guardRedirectMap = [
    //         'user'  => '/home',
    //         'coach' => '/coach/home',
    //         'admin' => '/admin/home',
    //     ];

    //     if (Auth::guard($role)->attempt($credentials, $remember)) {
    //         return redirect($guardRedirectMap[$role]);
    //     }

    //     return back()->withInput($request->only('email', 'role'))
    //          ->withErrors([
    //             'login' => 'メールアドレスまたはパスワードが間違っています。',
    //         ]);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // userガード
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect()->route('home');
        }

        // coachガード
        if (Auth::guard('coach')->attempt($credentials)) {
            return redirect()->route('coach.home');
        }

        // adminガード
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        }

        // どれにも当てはまらなかった場合
        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
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

        // セッションを無効化して再生成（セキュリティ対策）
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

