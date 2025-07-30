<?php

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

// ホーム画面
Route::get('/', function () {
    return view('home');
})->name('home');

// 習慣一覧
Route::get('/habits/index', function () {
    return view('habits/index');
})->name('habits.index');

Route::get('/habits/create', function () {
    return view('habits/create');
})->name('habits.create');

Route::get('/habits/store', function () {
    return view('habits/store');
})->name('habits.store');

Route::get('/habits/edit', function () {
    return view('habits/edit');
})->name('habits.edit');

Route::get('/habits/destroy', function () {
    return view('habits/destroy');
})->name('habits.destroy');


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

// コーチ用
Route::prefix('coach')->middleware('auth:coach')->name('coach.')->group(function () {
    Route::resource('users', 'Coach\UserController');
    Route::resource('comments', 'Coach\CoachCommentController');
});

// ユーザー用
Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
    Route::resource('habits', 'User\HabitController');
    Route::resource('logs', 'User\LogController');
    Route::resource('feedbacks', 'User\AiFeedbackController');
    
});