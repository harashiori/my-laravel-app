<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coach;



class CoachController extends Controller
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
        //$admin = Auth::guard('admin')->user();
        $coaches = Coach::paginate(10); // 10件ずつページネーション
        return view('admin.coaches', compact('coaches'));
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
        $coach = Coach::findOrFail($id);
        
        return view('admin.coach_edit', compact('coach'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coach = Coach::findOrFail($id);
        return view('admin.coach_edit', compact('coach'));
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
        $coach = Coach::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:coaches,email,' . $coach->id,
            'status' => 'in:pending,approved,rejected', // 承認ステータス
        ]);

        $coach->update($validated);

        return redirect()->route('admin.coaches')->with('success', 'コーチ情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coach = Coach::findOrFail($id);
        $coach->delete();

        return redirect()->route('admin.coaches')->with('success', 'コーチを削除しました');
    } 
    
    public function approve($id)
    {
        $coach = Coach::findOrFail($id);
        $coach->status = 1;
        $coach->save();

        //Ajaxの場合はJSONで返す
        if(request()->ajax()){
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.coaches');
    }    
}
