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
use App\Http\Controllers\CanchaFotoController;
use App\Http\Controllers\TipoCanchaController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoContactoController;
use App\Http\Controllers\HorarioCanchaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\TipoDomicilioController;
use App\Http\Controllers\TipoPagoController;
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

	
	// Route::middleware(['check.access'])->group(function(){
		Route::get('/gestion',[GestionController::class,'show']);
		Route::prefix('gestion')->group(function () {
			Route::get('/perfiles',[PerfilController::class,'show']);
			Route::get('/perfiles/{id}/editar',[PerfilController::class,'edit']);
			Route::post('/perfiles/{id}/update',[PerfilController::class,'update']);


			Route::get('/usuarios', [UserController::class,'index']);
			Route::get('/usuarios/{id}/editar', [UserController::class,'editPermisos']);
			Route::post('/usuarios/{id}/updatePermisos', [UserController::class,'updatePermisos']);

			Route::get('/canchas',[CanchaController::class,'showGestion']);
			Route::get('/canchas/create',[CanchaController::class,'create']);
			Route::post('/canchas/store',[CanchaController::class,'store']);
			Route::get('/canchas/{id}/editar',[CanchaController::class,'edit']);
			Route::post('/canchas/{id}/update',[CanchaController::class,'update']);

			Route::get('/fotos-canchas', [CanchaFotoController::class, 'index']);
			Route::get('/fotos-canchas/create/{id}', [CanchaFotoController::class, 'create']);
			Route::post('/fotos-canchas/store/{id}', [CanchaFotoController::class, 'store']);

			Route::get('/tipos-documento', [TipoDocumentoController::class,'index']);
			Route::get('/tipos-documento/create',[TipoDocumentoController::class,'create']);
			Route::post('/tipos-documento/store',[TipoDocumentoController::class,'store']);
			Route::get('/tipos-documento/{id}/editar',[TipoDocumentoController::class,'edit']);
			Route::post('/tipos-documento/{id}/update',[TipoDocumentoController::class,'update']);
			Route::get('/tipos-documento/{id}/delete',[TipoDocumentoController::class,'delete']);
			Route::get('/tipos-documento/{id}/restore',[TipoDocumentoController::class,'restore']);

			Route::get('/tipos-contacto',[TipoContactoController::class,'index']);
			Route::get('/tipos-contacto/create',[TipoContactoController::class,'create']);
			Route::post('/tipos-contacto/store',[TipoContactoController::class,'store']);
			Route::get('/tipos-contacto/{id}/editar',[TipoContactoController::class,'edit']);
			Route::post('/tipos-contacto/{id}/update',[TipoContactoController::class,'update']);
			Route::get('/tipos-contacto/{id}/delete',[TipoContactoController::class,'delete']);
			Route::get('/tipos-contacto/{id}/restore',[TipoContactoController::class,'restore']);

			Route::get('/horarios-canchas', [HorarioCanchaController::class, 'index']);
			Route::get('/horarios-cancha/create', [HorarioCanchaController::class, 'create']);
			Route::post('/horarios-cancha/store', [HorarioCanchaController::class, 'store']);
			Route::get('/horarios-cancha/{id}/editar', [HorarioCanchaController::class, 'edit']);
			Route::post('/horarios-cancha/{id}/update', [HorarioCanchaController::class, 'update']);
			Route::get('/horarios-cancha/{id}/delete',[HorarioCanchaController::class,'delete']);
			Route::get('/horarios-cancha/{id}/restore',[HorarioCanchaController::class,'restore']);

			Route::get('/tipos-cancha',[TipoCanchaController::class,'index']);
			Route::get('/tipos-cancha/create', [TipoCanchaController::class, 'create']);
			Route::post('/tipos-cancha/store', [TipoCanchaController::class, 'store']);
			Route::get('/tipos-cancha/{id}/editar', [TipoCanchaController::class, 'edit']);
			Route::post('/tipos-cancha/{id}/update', [TipoCanchaController::class, 'update']);
			Route::get('/tipos-cancha/{id}/delete',[TipoCanchaController::class,'delete']);
			Route::get('/tipos-cancha/{id}/restore',[TipoCanchaController::class,'restore']);

			Route::get('/metodos-pago', [MetodoPagoController::class, 'index']);
			Route::get('/metodos-pago/{id}/editar', [MetodoPagoController::class, 'edit']);
			Route::post('/metodos-pago/{id}/update', [MetodoPagoController::class, 'update']);
			Route::get('/metodos-pago/{id}/delete',[MetodoPagoController::class,'delete']);
			Route::get('/metodos-pago/{id}/restore',[MetodoPagoController::class,'restore']);

			Route::get('/tipos-domicilio', [TipoDomicilioController::class,'index'])->name('tipos-domicilio.index');
			Route::get('/tipos-domicilio/{id}/edit', [TipoDomicilioController::class,'edit'])->name('tipos-domicilio.edit');
			Route::get('/tipos-domicilio/create', [TipoDomicilioController::class,'create'])->name('tipos-domicilio.create');
			Route::post('/tipos-domicilio/{id}/update', [TipoDomicilioController::class,'update'])->name('tipos-domicilio.update');
			Route::post('/tipos-domicilio/store', [TipoDomicilioController::class,'store'])->name('tipos-domicilio.store');
			Route::get('/tipos-domicilio/{id}/delete', [TipoDomicilioController::class,'delete'])->name('tipos-domicilio.delete');
			Route::get('/tipos-domicilio/{id}/restore', [TipoDomicilioController::class,'restore'])->name('tipos-domicilio.restore');
		
			Route::get('/tipos-pago', [TipoPagoController::class,'index'])->name('tipopago.index');
			Route::get('/tipos-pago/{id}/edit', [TipoPagoController::class,'edit'])->name('tipopago.edit');
			Route::get('/tipos-pago/create', [TipoPagoController::class,'create'])->name('tipopago.create');
			Route::post('/tipos-pago/{id}/update', [TipoPagoController::class,'update'])->name('tipopago.update');
			Route::post('/tipos-pago/store',[TipoPagoController::class,'store'])->name('tipopago.store');
			Route::get('/tipos-pago/{id}/delete', [TipoPagoController::class,'delete'])->name('tipopago.delete');
			Route::get('/tipos-pago/{id}/restore', [TipoPagoController::class,'restore'])->name('tipopago.restore');
			
			
		});
	// });
});

Route::any('/login', [LoginController::class,'showLogin'])->name('login');
Route::post('/validateLogin',[LoginController::class,'login']);
Route::post('/validateRegister',[RegisterController::class,'validateRegister']);
Route::get('/register',[RegisterController::class,'show'])->name('register');
Route::get('/canchas',[CanchaController::class,'index'])->name('canchas');

