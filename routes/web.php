<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CanchaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function() {
	Route::get("/home", function(){return view('home');})->name('home');
	Route::get('/profile', [UserController::class, 'show']);
	Route::get('/logout', [LoginController::class,'logout'])->name('logout');
	Route::get('/reservas', [ReservaController::class,'index']);
	Route::get('/changePassword',[ChangePasswordController::class,'show']);
	Route::post('/validateChangePassword',[ChangePasswordController::class,'changePassword']);
});

Route::any('/login', [LoginController::class,'showLogin'])->name('login');
Route::post('/validateLogin',[LoginController::class,'login']);
Route::post('/validateRegister',[RegisterController::class,'validateRegister']);
Route::get('/register',[RegisterController::class,'show'])->name('register');
Route::get('/canchas',[CanchaController::class,'index'])->name('canchas');

