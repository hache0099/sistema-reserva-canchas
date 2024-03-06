<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    function show()
    {
		return view('auth.register');
	}
	
	function validateRegister(Request $request){
		$this->validate($request,[
			'email' => 'required|string|email|max:55',
			'password' => 'required|string|min:8',
			'password_confirmation' => 'required|string|min:8',
			'name' => 'required|string|max:45',
			'apellido' => 'required|string|max:45',
			'telefono' => 'required|numeric',
			'dni' => 'required|numeric',
		]);
		
		if ($request->password != $request->password_confirmation)
		{
			return back()->withErrors(['password_confirmation' => 'Las contraseñas no coinciden.']);
		}
		
		$user = User::create([
			'email' => $request->email,
			'pass' => $request->password
		]);
		
		$persona_id = Persona::create([
			'Nombre' => $request->name,
			'Apellido' => $request->apellido,
			'Telefono' => $request->telefono,
			'DNI' => $request->dni,
			'rela_usuario' => $user->id_usuario
		]);
		
		Auth::login($user);
		$request->session()->regenerate();
		return redirect()->intended(route('home'));
		
	}
}
