<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coach;
use Illuminate\Support\Facades\Hash;

class CoachApplyController extends Controller
{
    public function showForm()
    {
        return view('auth.coach_apply');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:coaches,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Coach::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'organization' => $request->input('organization'),
            'status' => 0, // またはデフォルト値が0
        ]);

        return redirect()->route('coach.apply')->with('success', 'コーチ申請を受け付けました。');
    }
}