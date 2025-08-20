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
use App\Http\Controllers\Coach\CoachCommentController;
use App\Http\Controllers\Coach\InviteController;
use App\Http\Controllers\Coach\CoachProfileController;

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CoachController;

use App\Models\Coach;
use App\Models\User;
use App\Models\Admin;


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


// Route::get('/', function () {
//         return view('auth/login');
//     });
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('auth.multi');

//ログインルート//
Route::middleware(['web'])->group(function () {
    Route::get('/auth/login', 'Auth\MultiGuardLoginController@showLoginForm')
        ->middleware('auth.multi')
        ->name('login');
    Route::post('/auth/login', 'Auth\MultiGuardLoginController@login')->name('login.post');
    Route::post('/auth/logout', 'Auth\MultiGuardLoginController@logout')->name('logout');

    // Route::get('/home', 'User\HomeController@index')->middleware('auth:user')->name('home');

    // Route::get('/coach/home', 'Coach\CoachHomeController@index')->middleware('auth:coach')->name('coach.home');

    // Route::get('/admin/home', 'Admin\AdminHomeController@index')->middleware('auth:admin')->name('admin.home');
});

// ユーザー用ルート
Route::middleware(['web', 'auth:user'])->group(function () {
    Route::get('/home', 'User\HomeController@index')
        ->name('home');
});

// コーチ用ルート
Route::middleware(['web', 'auth:coach'])->group(function () {
    Route::get('/coach/home', 'Coach\CoachHomeController@index')
        ->name('coach.home');
});

// 管理者用ルート
Route::middleware(['web', 'auth:admin'])->group(function () {
    Route::get('/admin/home', 'Admin\AdminHomeController@index')
        ->name('admin.home');
});


//新規登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


//コーチ申請画面
//申請画面の表示
Route::get('coach-apply', 'Auth\CoachApplyController@showForm')->name('coach.apply');

//申請送信処理（post）
Route::post('coach-apply', 'Auth\CoachApplyController@submit')->name('coach.apply.submit');


Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::resource('admin-homes', 'Admin\AdminHomeController');
    //ユーザー管理
    Route::resource('users', 'Admin\UserController');
    //コーチ管理
    Route::resource('coaches', 'Admin\CoachController');
    //コーチ申請認証アクション
    Route::patch('/coaches/{coach}/approve', 'Admin\CoachController@approve')->name('coaches.approve');

    
    //  通知設定画面（1ページのみ表示）
    Route::get('notification_settings', function () {
         return view('admin.notification_settings');
        })->name('notification_settings');

    // Route::get('/admin/notification_settings', function () {
    //     return view('admin/notification_settings');
    // })->name('admin.notification_settings');

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
    Route::get('/habits/calendar', 'User\HabitController@calendar')->name('habits.calendar');
    
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

    Route::get('/pdf-test', 'User\ReportController@generate')->name('test.pdf');
});

// コーチ用
Route::prefix('coach')->middleware('auth:coach')->name('coach.')->group(function () {
    Route::resource('coach-homes', 'Coach\CoachHomeController');
    Route::resource('users', 'Coach\UserDetailController');
    Route::resource('comments', 'Coach\CoachCommentController');
    Route::resource('invites', 'Coach\InviteController');
    Route::resource('coach-profiles', 'Coach\CoachProfileController');

});

