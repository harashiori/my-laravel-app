<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LogController extends Controller
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
    public function index(Request $request)
    {
        // $logs = Log::where('user_id', Auth::id())->get();
        // return view('logs.index', compact('logs'));

        $user = Auth::user();

        // ユーザーの習慣一覧を取得（セレクトボックス用）
        $habits = Habit::where('user_id', $user->id)->get();

        // ログのクエリを作成
        $query = Log::where('user_id', $user->id);

        // 検索条件（habit_id）があれば絞り込み
        if ($request->filled('habit_id')) {
            $query->where('habit_id', $request->habit_id);
        }

        // ログ取得
        $logs = $query->orderBy('created_at', 'desc')->get();

        // ビューに渡す
        return view('logs.index', compact('logs', 'habits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $habits = Habit::where('user_id', $user->id)->get();

        return view ('logs.session', compact('habits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'concentration' => 'nullable|integer|min:1|max:5',
            'satisfaction' => 'nullable|integer|min:1|max:5',
        ]);


        $start = Carbon::parse($request->start_time)->timezone('Asia/Tokyo');
        $end = Carbon::parse($request->end_time)->timezone('Asia/Tokyo');
        $duration = $start->diffInMinutes($end); // 実施時間

        $log = new Log();
        $log->user_id = Auth::id();
        $log->habit_id = $request->habit_id;
        //Carbonを使ってMySQLに合った形式に変換
        $log->start_time = Carbon::parse($request->start_time)->timezone('Asia/Tokyo');
        $log->end_time = Carbon::parse($request->end_time)->timezone('Asia/Tokyo');
        $log->concentration = $request->concentration ?: null;
        $log->satisfaction = $request->satisfaction ?: null;
        $log->duration = $duration; // 分単位で保存
        $log->save();

        return redirect()->route('user.logs.index')->with('success', 'セッションを記録しました');
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
