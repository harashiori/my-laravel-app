<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Habit;
use App\Models\Log;

class HomeController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        // ユーザーの習慣一覧（複数の習慣がある想定）
        $habits = Habit::where('user_id', $user->id)->get();

        // 各習慣の継続日数を計算して配列に
        // ここでは継続日数を「連続して習慣達成している日数」と仮定
        foreach ($habits as $habit) {
            $habit->streak_days = $habit->calculateStreakDays();  // Habitモデルにメソッドを作る想定
        }

        // 直近5件のログ（全習慣のログをまとめて取得し、最新5件）
        $logs = Habit::where('user_id', $user->id)->get();

        $logs = Log::whereHas('habit', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orderBy('created_at', 'desc')
          ->limit(5)
          ->get();

        return view('home', compact('habits', 'logs'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
