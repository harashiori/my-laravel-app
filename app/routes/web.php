<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\MultiGuardLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\CoachApplyController;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\HabitController;
use App\Http\Controllers\User\LogController;
use App\Http\Controllers\User\AiFeedbackController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\NotificationSettingController;

use App\Http\Controllers\Coach\CoachHomeController;
use App\Http\Controllers\Coach\UserDetailController;

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
        return view('auth/login');
    });

// ホーム画面
// Route::get('/', function () {
//     return view('auth.login');
// })->name('login');



//ログインルート//
Route::middleware(['web'])->group(function () {
    Route::get('/auth/login', 'Auth\MultiGuardLoginController@showLoginForm')->name('login');
    Route::post('/auth/login', 'Auth\MultiGuardLoginController@login')->name('login.post');
    Route::post('/auth/logout', 'Auth\MultiGuardLoginController@logout')->name('logout');

    Route::get('/home', 'User\HomeController@index')->middleware('auth:user')->name('home');

    Route::get('/coach/home', 'Coach\CoachHomeController@index')->middleware('auth:coach')->name('coach.home');

    Route::get('/admin/home', function () {
        return view('admin.home');
    })->middleware('auth:admin');
});

//新規登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


//コーチ申請画面
//申請画面の表示
Route::get('coachapply', 'Auth\CoachApplyController@showForm')->name('coach.apply');

//申請送信処理（post）
Route::post('coachapply', 'Auth\CoachApplyController@submit')->name('coach.apply.submit');


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
    Route::resource('homes', 'User\HomeController');
    Route::resource('habits', 'User\HabitController');
    Route::resource('logs', 'User\LogController');
    Route::resource('aifeedbacks', 'User\AiFeedbackController');
    Route::resource('reports', 'User\ReportController');
    Route::resource('profiles', 'User\ProfileController');

    //スケジュールカレンダー
    Route::get('habits/calendar', 'User\HabitController@calendar')->name('habits.calendar');
    
    //PDF出力用ルート
    Route::post('reports/{id}/pdf', 'User\ReportController@exportPdf')->name('reports.pdf');
    
    
    // 通知設定ページ
    Route::get('/settings/notifications', 'User\NotificationSettingController@index')
        ->name('settings.notifications');
    // ON/OFF切り替え
    Route::post('/settings/notifications/toggle', 'User\NotificationSettingController@toggle')
        ->name('settings.notifications.toggle');
    // FCMトークン保存
    Route::post('/settings/notifications/token', 'User\NotificationSettingController@updateToken')
        ->name('settings.notifications.token');
});





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
Route::prefix('coach')->middleware('auth:coach')->name('coach.')->group(function () {
    Route::resource('coachhomes', 'Coach\CoachHomeController');
    Route::resource('users', 'Coach\UserDetailController');
    Route::resource('comments', 'Coach\CoachCommentController');
    Route::resource('invites', 'Coach\InviteController');

});

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

