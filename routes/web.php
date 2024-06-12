<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\TipoCanchaController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoContactoController;
use App\Http\Controllers\HorarioCanchaController;
use App\Models\TipoContacto;
use App\Models\TipoDocumento;

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
	Route::get('/profile', [ProfileController::class, 'show']);
	Route::get('/profile/editar', [ProfileController::class, 'edit']);
	Route::post('/profile/actualizar', [ProfileController::class, 'update']);
	Route::get('/logout', [LoginController::class,'logout'])->name('logout');
	Route::get('/reservas', [ReservaController::class,'index']);
	Route::get('/changePassword',[ChangePasswordController::class,'show']);
	Route::post('/validateChangePassword',[ChangePasswordController::class,'changePassword']);

	Route::get('/gestion',[GestionController::class,'show']);
	Route::prefix('gestion')->group(function () {
		Route::get('/canchas',[CanchaController::class,'showGestion']);
		Route::get('/canchas/create',[CanchaController::class,'create']);
		Route::get('/canchas/{id}/editar',[CanchaController::class,'edit']);

		Route::get('/tipos-documento', [TipoDocumentoController::class,'index']);
		Route::get('/tipos-documento/create',[TipoDocumentoController::class,'create']);
		Route::post('/tipos-documento/store',[TipoDocumentoController::class,'store']);
		Route::get('/tipos-documento/{id}/editar',[TipoDocumentoController::class,'edit']);
		Route::post('/tipos-documento/{id}/update',[TipoDocumentoController::class,'update']);

		Route::get('/tipos-contacto',[TipoContactoController::class,'index']);
		Route::get('/tipos-contacto/create',[TipoContactoController::class,'create']);
		Route::post('/tipos-contacto/store',[TipoContactoController::class,'store']);
		Route::get('/tipos-contacto/{id}/editar',[TipoContactoController::class,'edit']);
		Route::post('/tipos-contacto/{id}/update',[TipoContactoController::class,'update']);

		Route::get('/horarios-canchas', [HorarioCanchaController::class, 'index']);
		Route::get('/horarios-cancha/create', [HorarioCanchaController::class, 'create']);
		Route::post('/horarios-cancha/store', [HorarioCanchaController::class, 'store']);
		Route::get('/horarios-cancha/{id}/editar', [HorarioCanchaController::class, 'edit']);
		Route::post('/horarios-cancha/{id}/update', [HorarioCanchaController::class, 'update']);

		Route::get('/tipos-cancha',[TipoCanchaController::class,'index']);
	});
});

Route::any('/login', [LoginController::class,'showLogin'])->name('login');
Route::post('/validateLogin',[LoginController::class,'login']);
Route::post('/validateRegister',[RegisterController::class,'validateRegister']);
Route::get('/register',[RegisterController::class,'show'])->name('register');
Route::get('/canchas',[CanchaController::class,'index'])->name('canchas');

