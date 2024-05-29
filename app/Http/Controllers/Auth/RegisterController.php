<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use App\Models\TipoDocumento;
use App\Models\TipoContacto;
use App\Models\PersonaContacto;
use App\Models\PersonaDocumento;
use App\Models\Domicilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    function show()
    {
		$tiposDocumento = TipoDocumento::all();
		$tiposContacto = TipoContacto::all();
		return view('auth.register', [
			// 'tiposContacto' => $tiposContacto,
			'tiposDocumento' => $tiposDocumento
		]);
	}
	
	function validateRegister(Request $request){
		$this->validate($request,[
			'email' => 'required|string|email|max:55',
			'password' => 'required|string|min:8',
			'password_confirmation' => 'required|string|min:8',
			'name' => 'required|string|max:45',
			'apellido' => 'required|string|max:45',
			'telefono' => 'required|numeric',
			'tipodni' => 'required|numeric',
			'dni' => 'required|numeric',
			'domicilio' => 'required|max:100',
			'fechanac' => 'required|date',
		]);
		
		if ($request->password != $request->password_confirmation)
		{
			return back()->withErrors(['password_confirmation' => 'Las contraseñas no coinciden.']);
		}
		
		
		$persona_id = Persona::create([
			'Nombre' => $request->name,
			'Apellido' => $request->apellido,
			'Telefono' => $request->telefono,
			'FechaNacimiento' => $request->fechanac,
		]);

		$domicilio = Domicilio::create([
			'Domicilio_detalle' => $request->domicilio,
			'rela_persona' => $persona_id,
		]);

		$persona_doc = PersonaDocumento::create([
			'PesonaDocumento_desc' => $request->dni,
			'Persona_idPersona' => $persona_id,
			'TipoDocumento_idTipoDocumento' => $request->tipodni,
		]);
		
		$user = User::create([
			'email' => $request->email,
			'pass' => $request->password,
			'rela_persona' => $persona_id
		]);

		Auth::login($user);
		$request->session()->regenerate();
		return redirect()->intended(route('home'));
		
	}
}
