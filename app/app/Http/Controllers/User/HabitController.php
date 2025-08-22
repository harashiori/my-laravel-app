<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user'); //必ずuserガードを使う
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧表示
    public function index()
    {
        //ログインユーザーの習慣だけ取得
        //$habits = Habit::all(); //habitモデルから取得
        $habits = Habit::where('user_id', Auth::id())->get();
        return view('habits.index', compact('habits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //新規作成フォーム表示
    public function create()
    {
        //dd(Auth::guard('user')->check(), Auth::user());
        //trueが返ればログインできている

        return view('habits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //保存処理    
    public function store(Request $request)
    {

        //dd('store method called');
        //dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'frequency'=> 'required|integer|min:1',
            'schedule_time' => 'required|date_format:H:i',
            'notification_time' => 'date_format:H:i',
        ]);

        //dd($validated);

        Habit::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'frequency' => $validated['frequency'],
            'schedule_time' => $validated['schedule_time'],
            'notification_time' => $validated['notification_time'],
        ]);
        

        return redirect()->route('user.habits.index')->with('success', '習慣を追加しました');  
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
    //編集フォーム表示
    public function edit(Habit $habit)
    {
        return view('habits.edit', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //更新処理
    public function update(Request $request, Habit $habit)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:30',
        'frequency'=> 'required|integer|min:1|max:7',
        'schedule_time' => 'required|date_format:H:i:s',
        'notification_time' => 'nullable|date_format:H:i:s',
        ]);

        $habit->update($validated);


        return redirect()->route('user.habits.index')->with('success', '習慣を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //削除処理
    public function destroy(Habit $habit)
    {
        $habit->delete();
        return redirect()->route('user.habits.index')->with('success', '習慣を削除しました');
    }


    //スケジュールカレンダー表示
     public function calendar()
    {
        $habits = Habit::where('user_id', Auth::id())->get();
        
        return view('habits.calendar', compact('habits'));

    }
}
