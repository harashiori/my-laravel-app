<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // ユーザーの習慣を取得
        $habits = $user->habits()->get();
        return view('settings.notifications', compact('user', 'habits'));
    }

    public function toggle(Request $request)
    {
        $user = Auth::user();
        $user->notification_on = $request->has('notification_on');
        $user->save();

        return back()->with('success', '通知設定を変更しました。');
    }

    public function updateToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $user = Auth::user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json(['status' => 'ok']);
    }
}
