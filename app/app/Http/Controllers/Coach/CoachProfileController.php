<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Coach;


class CoachProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:coach');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ログイン中のユーザー情報を取得
        //$user = Auth::coach();
        $coach = Auth::guard('coach')->user();

        return view('coach.profile', compact('coach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coach = Auth::guard('coach')->user();
        return view('coach.profile_edit', compact('coach'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $coach = Auth::guard('coach')->user();

        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:coaches,email,' . $coach->id,
            'organization' => 'required|max:100',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // 更新処理
        $coach->name = $validated['name'];
        $coach->email = $validated['email'];
        $coach->organization = $validated['organization'];

        if (!empty($validated['password'])) {
            $coach->password = Hash::make($validated['password']);
        }

        $coach->save();

        return redirect()->route('user.profiles.index')->with('success', 'プロフィールを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $coach = Auth::guard('coach')->user();
        $coach->delete();

        // セッションも無効化
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // ログインページへリダイレクト
        return redirect()->route('login');
    }
}
