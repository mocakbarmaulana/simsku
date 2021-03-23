<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\FrontController::class, 'home'])->name('home');
Route::get('/detail/{id}', [App\Http\Controllers\FrontController::class, 'detail'])->name('home.detail');


Auth::routes();

// Member Route
Route::group(['prefix' => 'member', 'namespace' => 'member'], function(){
    Route::get('/login', [App\Http\Controllers\Member\LoginMemberController::class, 'login'])->name('member.login');
    Route::get('/register', [App\Http\Controllers\Member\LoginMemberController::class, 'register'])->name('member.register');
    Route::post('/login', [App\Http\Controllers\Member\LoginMemberController::class, 'authenticate'])->name('member.login_proses');
    Route::post('/register', [App\Http\Controllers\Member\LoginMemberController::class, 'memberRegister'])->name('member.register_proses');
    Route::get('/logout', [App\Http\Controllers\Member\LoginMemberController::class, 'logout'])->name('member.logout');

    Route::get('/order', [App\Http\Controllers\Member\MemberController::class, 'getOrderAll'])->name('member.getorder');
    Route::get('/order/detail/{id}', [App\Http\Controllers\Member\MemberController::class, 'getOrderDetail'])->name('member.getorderdetail');

    Route::get('/account', [App\Http\Controllers\Member\MemberController::class, 'getAccount'])->name('member.account');
    Route::put('/account/update/{id}', [App\Http\Controllers\Member\MemberController::class, 'setUpdateAccount'])->name('member.update_account');

    Route::get('/course', [App\Http\Controllers\Member\MemberController::class, 'getCourseAll'])->name('member.getcourseall');
    Route::get('/course/detail/{id}', [App\Http\Controllers\Member\MemberController::class, 'getDetailCourse'])->name('member.getdetailcourse');

    Route::post('/order/{id}', [App\Http\Controllers\Member\MemberController::class, 'setOrder'])->name('member.setorder');
    Route::post('/payment', [App\Http\Controllers\Member\MemberController::class, 'payment'])->name('member.payment');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Route
// Route::get('/skill', [App\Http\Controllers\Admin\SkillController::class, 'index'])->name('admin.skill');
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function(){
    Route::resource('course', 'App\Http\Controllers\Admin\CourseController');
    Route::resource('skill', 'App\Http\Controllers\Admin\SkillController');
    Route::resource('teacher', 'App\Http\Controllers\Admin\TeacherController');
    Route::resource('learner', 'App\Http\Controllers\Admin\LearnerController');
    Route::resource('order', 'App\Http\Controllers\Admin\OrderController');
    Route::resource('payment', 'App\Http\Controllers\Admin\PaymentController');
});


// Expert Route Login
Route::group(['prefix' => 'expert', 'namespace' => 'expert'], function(){
    Route::get('/login', [App\Http\Controllers\Expert\LoginExpertController::class, 'index'])->name('expert.login');
    Route::post('/login', [App\Http\Controllers\Expert\LoginExpertController::class, 'authenticate'])->name('expert.login_proses');
});

// Expert Route
Route::group(['prefix' => 'expert', 'middleware' => 'expert'], function(){
    Route::get('/class', [App\Http\Controllers\Expert\ClassController::class, 'index'])->name('expert.class');
    Route::get('/class/create', [App\Http\Controllers\Expert\ClassController::class, 'create'])->name('expert.class.create');
    Route::get('/class/edit/{id}', [App\Http\Controllers\Expert\ClassController::class, 'edit'])->name('expert.class.edit');
    Route::put('/class/update/{id}', [App\Http\Controllers\Expert\ClassController::class, 'update'])->name('expert.class.update');
    Route::delete('/class/delete/{id}', [App\Http\Controllers\Expert\ClassController::class, 'destroy'])->name('expert.class.delete');
    Route::post('/class/store', [App\Http\Controllers\Expert\ClassController::class, 'store'])->name('expert.class.store');

    Route::get('/logout', [App\Http\Controllers\Expert\LoginExpertController::class, 'logout'])->name('expert.logout');
});

// Logout
Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logoutAll');