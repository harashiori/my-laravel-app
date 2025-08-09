<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\MultiGuardLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\CoachApplyController;

// use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\CoachController;
// use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\User\HabitController;
use App\Http\Controllers\User\LogController;
use App\Http\Controllers\User\AiFeedbackController;
use App\Http≠Controllers\User\ReportController;

use App\Models\Coach;
use App\Models\User;


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

// ユーザー（LaravelUIのauthで自動生成）
//Auth::routes();


Route::get('/', function () {
        return view('home');
    })->name('home');

// ホーム画面
// Route::get('/', function () {
//     return view('auth.login');
// })->name('login');



//ログインルート//
Route::middleware(['web'])->group(function () {
    Route::get('/auth/login', 'Auth\MultiGuardLoginController@showLoginForm')->name('login');
    Route::post('/auth/login', 'Auth\MultiGuardLoginController@login')->name('login.post');
    Route::post('/auth/logout', 'Auth\MultiGuardLoginController@logout')->name('logout');

    Route::get('/home', function () {
        return view('home');
    })->middleware('auth:user');

    Route::get('/coach/home', function () {
        return view('coach.home');
    })->middleware('auth:coach');

    Route::get('/admin/home', function () {
        return view('admin.home');
    })->middleware('auth:admin');
});

//新規登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


//コーチ申請画面
//申請画面の表示
Route::get('/auth/coach_apply', function () {
    return view('auth.coach_apply'); // 例：resources/views/auth/coach_apply.blade.php
})->name('coach.apply');

//申請送信処理（post）
Route::post('/auth/coach_apply', function (Request $request) {
    
return redirect()->route('coach.apply')->with('success', '申請を受け付けました！');
})->name('coach.apply.submit');



Route::prefix('admin')
    ->middleware('auth:admin')
    ->name('admin.')
    ->group(function () {

    //管理ダッシュボード
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    // // ユーザー管理（CRUD）
    // Route::resource('users', UserController::class); // 自動で index/show/edit/etc 作成される

    // // コーチ管理（CRUD）
    // Route::resource('coaches', CoachController::class);

    // // 管理者管理（必要であれば）
    // Route::resource('admins', AdminController::class);

    // // 通知設定画面（1ページのみ表示）
    // Route::get('notification_settings', function () {
    //     return view('admin.notification_settings');
    // })->name('notification_settings');

    // //コーチ申請認証アクション
    // Route::patch('/coaches/{coach}/approve', [CoachController::class, 'approve'])->name('coaches.approve');

});



// ユーザー用
Route::prefix('user')->middleware('auth:user')->name('user.')->group(function () {
    Route::resource('habits', 'User\HabitController');
    Route::resource('logs', 'User\LogController');
    Route::resource('aifeedbacks', 'User\AiFeedbackController');
    Route::resource('reports', 'User\ReportController');

    //PDF出力用ルート
    Route::post('reports/{id}/pdf', 'User\ReportController@exportPdf')->name('reports.pdf');
    
    // ホーム画面
    Route::get('/', function () {
        return view('home');
    })->name('home');


   


});


Route::get('/habits/calendar', function () {
    return view('habits/calendar');
})->name('habits.calendar');



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
// Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
//     Route::resource('users', 'Admin\UserController');
//     Route::resource('coaches', 'Admin\CoachController');
//     Route::resource('admins', 'Admin\AdminController');
// });


// Route::get('/admin/home', function () {
//     return view('admin/home');
// })->name('admin.home');

// Route::get('/admin/users', function () {
//     return view('admin/users');
// })->name('admin.users');

// Route::get('/admin/user_edit', function () {
//     return view('admin/user_edit');
// })->name('admin.user_edit');

// Route::get('/admin/coaches', function () {
//     return view('admin/coaches');
// })->name('admin.coaches');

// Route::get('/admin/coach_edit', function () {
//     return view('admin/coach_edit');
// })->name('admin.coach_edit');

// Route::get('/admin/notification_settings', function () {
//     return view('admin/notification_settings');
// })->name('admin.notification_settings');








// コーチ用
// Route::prefix('coach')->middleware('auth:coach')->name('coach.')->group(function () {
//     Route::resource('users', 'Coach\UserController');
//     Route::resource('comments', 'Coach\CoachCommentController');
// });

// Route::get('/coach/home', function () {
//     return view('coach/home');
// })->name('coach.home');

// Route::get('/coach/invite', function () {
//     return view('coach/invite');
// })->name('coach.invite');

// Route::get('/coach/user_detail', function () {
//     return view('coach/user_detail');
// })->name('coach.user_detail');

// Route::get('/coach/comment', function () {
//     return view('coach/comment');
// })->name('coach.comment');

