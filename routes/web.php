<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MeetingController;

Route::get('/', function () {
  return view('index');
})->name('home');

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login', [AuthController::class, "loginPost"])->name("login.post");

Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class, "registerPost"])->name("register.post");

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/send-message', [ChatController::class, 'sendMessage']);

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/book', function () {
    return view('book');
})->name('book');

//Forgot password
Route::view('forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail']);
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');

//Email authincation of user
Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');
//Email verification Handler route
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify'); 
//Resending the verification email route
Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Booking route
Route::post('/book', [BookingController::class, 'store'])->name('book.store');

//admin
Route::get('admin' ,[App\Http\Controllers\BookingController::class, 'admin']);
Route::put('/meetings/{id}', [MeetingController::class, 'update'])->name('meetings.update');

Route::get('/chat', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chat/send', [ChatController::class, 'handle'])->name('chat.send');