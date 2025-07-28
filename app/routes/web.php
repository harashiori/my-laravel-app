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

Route::get('/', function () {
    return view('welcome');
});


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
    Route::resource('feedbacks', 'Coach\AiFeedbackController');
});

// ユーザー用
Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
    Route::resource('habits', 'User\HabitController');
    Route::resource('logs', 'User\LogController');
});