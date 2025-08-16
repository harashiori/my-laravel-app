<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Coach;
use App\Models\Habit;


class AdminHomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        // 統計情報
        $userCount  = User::count();
        $coachCount = Coach::count();
        $totalCount = $userCount + $coachCount; //登録ユーザーの合計
        
        // 最近のアクティビティ
        // 最新のユーザー登録
        $userActivities = User::select('id','name','created_at')
            ->orderBy('created_at','desc')
            ->get()
            ->map(function($user){
                return [
                    'type' => 'user',
                    'name' => $user->name,
                    'date' => $user->created_at,
                ];
            });

        // 最新のコーチ登録
        $coachActivities = Coach::select('id','name','created_at')
            ->orderBy('created_at','desc')
            ->get()
            ->map(function($coach){
                return [
                    'type' => 'coach',
                    'name' => $coach->name,
                    'date' => $coach->created_at,
                ];
            });

        // 最新の習慣カテゴリ登録
        $categoryActivities = Habit::with('user')
            ->orderBy('created_at','desc')
            ->get()
            ->map(function($cat){
                return [
                    'type' => 'habit',
                    'name' => $cat->name,
                    'date' => $cat->created_at,
                    'user' => optional($cat->user)->name ?? '削除済みユーザー',
                ];
            });

        // 配列を統合して作成日時でソート
        $activities = $userActivities
            ->merge($coachActivities)
            ->merge($categoryActivities)
            ->sortByDesc('date')
            ->take(10); // 最新10件だけ表示


        return view('admin.home', compact('userCount', 'coachCount', 'totalCount', 'activities'));
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
