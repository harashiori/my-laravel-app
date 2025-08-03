<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\User\HabitController;
use App\Http\Controllers\User\LogController;
use App\Http\Controllers\User\AiFeedbackController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function() {
//     return view('index');
// }):

//ログイン認証//
//ユーサー用
Auth::routes(); 



Route::prefix('admin')
    ->middleware('auth:admin')
    ->name('admin.')
    ->group(function () {

    //管理ダッシュボード
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    // ユーザー管理（CRUD）
    Route::resource('users', UserController::class); // 自動で index/show/edit/etc 作成される

    // コーチ管理（CRUD）
    Route::resource('coaches', CoachController::class);

    // 管理者管理（必要であれば）
    Route::resource('admins', AdminController::class);

    // 通知設定画面（1ページのみ表示）
    Route::get('notification_settings', function () {
        return view('admin.notification_settings');
    })->name('notification_settings');

    //コーチ申請認証アクション
    Route::patch('/coaches/{coach}/approve', [CoachController::class, 'approve'])->name('coaches.approve');

});





//ログイン画面
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/auth/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->has('remember'))) {
        // 認証成功時：ログイン成功
        return redirect()->intended(route('home'));
    }

    // 認証失敗
    return back()->withErrors([
        'email' => 'メールアドレスかパスワードが間違っています。',
    ])->withInput();
})->name('login.post');







Route::post('/auth/register', function () {
    return view('auth/register');
})->name('register');

Route::post('/auth/coach_apply', function () {
    return view('auth/coach_apply');
})->name('coach.apply');



// ユーザー用
Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
    Route::resource('habits', 'User\HabitController');
    Route::resource('logs', 'User\LogController');
    Route::resource('feedbacks', 'User\AiFeedbackController');
    
    // ホーム画面
    Route::get('/', function () {
        return view('home');
    })->name('home');

});



// ホーム画面
Route::get('/', function () {
    return view('home');
})->name('home');

// 習慣一覧
// Route::get('/habits/index', function () {
//     return view('habits/index');
// })->name('habits/index');

// Route::get('/habits/create', function () {
//     return view('habits/create');
// })->name('habits.create');

// Route::get('/habits/store', function () {
//     return view('habits/store');
// })->name('habits.store');

// Route::get('/habits/edit', function () {
//     return view('habits/edit');
// })->name('habits.edit');

// Route::get('/habits/destroy', function () {
//     return view('habits/destroy');
// })->name('habits.destroy');


Route::get('/habits/calendar', function () {
    return view('habits/calendar');
})->name('habits.calendar');



// 仮のAIフィードバック
Route::get('/gpt/summary', function () {
    return view('gpt/summary');
})->name('gpt.summary');

Route::get('/report/index', function () {
    return view('report/index');
})->name('report.index');

Route::get('/report/preview', function () {
    return view('report/preview');
})->name('report.preview');



// ログ
Route::get('/logs/session', function () {
    return view('logs/session');
})->name('logs.session');


Route::get('/logs/index', function () {
    return view('logs/index');
})->name('logs.index');

Route::get('/logs/analytics', function () {
    return view('logs/analytics');
})->name('logs.analytics');


//設定
Route::get('/profile/index', function () {
    return view('profile/index');
})->name('profile.index');


Route::get('/profile/edit', function () {
    return view('profile/edit');
})->name('profile.edit');


Route::get('/settings/notifications', function () {
    return view('settings/notifications');
})->name('settings.notifications');




// 管理者用
Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::resource('users', 'Admin\UserController');
    Route::resource('coaches', 'Admin\CoachController');
    Route::resource('admins', 'Admin\AdminController');
});


Route::get('/admin/home', function () {
    return view('admin/home');
})->name('admin.home');

Route::get('/admin/users', function () {
    return view('admin/users');
})->name('admin.users');

Route::get('/admin/user_edit', function () {
    return view('admin/user_edit');
})->name('admin.user_edit');

Route::get('/admin/coaches', function () {
    return view('admin/coaches');
})->name('admin.coaches');

Route::get('/admin/coach_edit', function () {
    return view('admin/coach_edit');
})->name('admin.coach_edit');

Route::get('/admin/notification_settings', function () {
    return view('admin/notification_settings');
})->name('admin.notification_settings');








// コーチ用
// Route::prefix('coach')->middleware('auth:coach')->name('coach.')->group(function () {
//     Route::resource('users', 'Coach\UserController');
//     Route::resource('comments', 'Coach\CoachCommentController');
// });

Route::get('/coach/home', function () {
    return view('coach/home');
})->name('coach.home');

Route::get('/coach/invite', function () {
    return view('coach/invite');
})->name('coach.invite');

Route::get('/coach/user_detail', function () {
    return view('coach/user_detail');
})->name('coach.user_detail');

Route::get('/coach/comment', function () {
    return view('coach/comment');
})->name('coach.comment');

