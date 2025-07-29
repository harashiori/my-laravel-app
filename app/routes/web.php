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
Route::get('/habits.index', function () {
    return view('habits/index');
})->name('habits.index');

Route::get('/habits.create', function () {
    return view('habits/create');
})->name('habits.create');

Route::get('/habits.store', function () {
    return view('habits/store');
})->name('habits.store');

Route::get('/habits.edit', function () {
    return view('habits/edit');
})->name('habits.edit');

Route::get('/habits.destroy', function () {
    return view('habits/destroy');
})->name('habits.destroy');


Route::get('/habits.calender', function () {
    return view('habits/calender');
})->name('habits.calender');

// 仮のAIフィードバック
Route::get('/ai-feedback', function () {
    return view('gpt.summary');
})->name('gpt.summary');

// 仮のログ一覧
Route::get('/logs', function () {
    return view('log.index');
})->name('log.index');










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