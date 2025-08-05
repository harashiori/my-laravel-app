<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachLoginController extends Controller
{
    //ログインしていないコーチのみ許可
    //=ログイン済みのコーチがログイン画面（/coach/login）にアクセスできないようにする
    public function __construct()
    {
        $this->middleware('guest:coach')->except('logout');
    }


    //ログインフォームを表示させる
    public function showLoginForm()
    {
        return view('/auth/login');
    }

    //ログインメソッド（バリデーション＋ログイン試行＋リダイレクト）
    public function login(Request $request)
    {
        //バリテーション
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //guard('coach'):コーチ用認証
        //attempt([...]):coachesテーブル内にあるemailとpasswordの一致するレコートを探す   
        
        if (Auth::guard('coach')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            //ログインが成功した場合は/coach/homeに遷移
            return redirect('/coach/home');
        }

        //失敗した場合はエラーメッセージを表示
        //入力内容(email)は保持
        return back()->withInput($request->only('email', 'remember'))
                     ->withErrors([
                        'email' => 'メールアドレスが間違っています',
                        'password' => 'パスワードが間違っています',
                    ]);
    }

    //ログアウトメソッド
    //セッションを削除、ログインページに戻す
    public function logout()
    {
        Auth::guard('coach')->logout();
        return redirect('/auth/login');
    }
}

