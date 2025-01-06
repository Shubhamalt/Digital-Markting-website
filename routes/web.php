<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/index', function () {
    return view('index');
})->name('home');

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login', [AuthController::class, "loginPost"])->name("login.post");

Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class, "registerPost"])->name("register.post");


Route::post('/send-message', [ChatController::class, 'sendMessage']);


Route::get('/about', function () {
    return view('about');
});


Route::get('/book', function () {
    return view('book');
});