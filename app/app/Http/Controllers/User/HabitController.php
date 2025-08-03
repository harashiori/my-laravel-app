<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧表示
    public function index()
    {
        $habits = Habit::all(); //habitモデルから取得
        return view ('habits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //新規作成フォーム表示
    public function create()
    {
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
        $request->validate([
        'name' => 'required|string|max:30',
        'frequency'=> 'required|string|max:30',
        'scheduled_time' => 'required|int'
        ]);

        Habit::create($request->all());

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
    public function edit($id)
    {
        $habit = Habit::findOrFail($id);
        return view('habits.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //更新処理
    public function update(Request $request, $id)
    {
        $habit = Habit::findOrFail($id);

        $request->validate([
        'name' => 'required|string|max:30',
        'frequency'=> 'required|string|max:30',
        'scheduled_time' => 'required|int'
        ]);

        $habit->update($request->all());

        return redirect()->route('user.habits.index')->with('success', '更新されました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //削除処理
    public function destroy($id)
    {
        $habit = Habit::findOrFail($id);
        $habit->delete();

        return redirect()->route('user.habits.index')->with('success', '削除されました');
    }
}
