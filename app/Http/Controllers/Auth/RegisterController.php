<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use App\Models\Perfil;
use App\Models\TipoDocumento;
use App\Models\TipoContacto;
use App\Models\PersonaContacto;
use App\Models\PersonaDocumento;
use App\Models\Domicilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

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
		$valido = $request->validate([
			'email' => 'required|string|email|max:55',
			'password' => 'required|string|min:8',
			'password_confirmation' => 'required|string|min:8',
			'name' => 'required|string|max:45',
			'apellido' => 'required|string|max:45',
			'telefono' => 'required|numeric',
			'tipodni' => 'required|numeric|min:1',
			'dni' => 'required|numeric',
			'domicilio' => 'required|max:100',
			'fechanac' => 'required|date',
		]);
		
		if ($request->password != $request->password_confirmation)
		{
			return back()->withErrors(['password_confirmation' => 'Las contraseñas no coinciden.']);
		}

		if ($request->tipodni < 1){
			return back()->withErrors(['tipodni' => 'Escoja un tipo de DNI']);
		}
		
		try {
			DB::beginTransaction();
			$persona = Persona::create([
				'Nombre' => $request->name,
				'Apellido' => $request->apellido,
				//'Telefono' => $request->telefono,
				'FechaNacimiento' => $request->fechanac,
			]);

			$domicilio = Domicilio::create([
				'Domicilio_detalle' => $request->domicilio,
				'rela_persona' => $persona->id_persona,
			]);

			$persona_doc = PersonaDocumento::create([
				'PesonaDocumento_desc' => $request->dni,
				'Persona_id_persona' => $persona->id_persona,
				'TipoDocumento_id_TipoDocumento' => $request->tipodni,
			]);

			$persona_contacto = PersonaContacto::create([
				'PersonaContacto_desc' => $request->telefono,
				'rela_persona' => $persona->id_persona,
				'rela_tipocontacto' => TipoContacto::where('Contacto_descripcion', 'Telefono')
					->first()->idContacto,
			]);
			
			$user = User::create([
				'email' => $request->email,
				'password' => $request->password,
				'rela_persona' => $persona->id_persona,
				'rela_perfil' => Perfil::where('Perfil_descripcion', 'Usuario')->value('idPerfil'),
				'fecha_alta' => date('Y-m-d')
			]);
			DB::commit();
		} catch (Throwable $exception) {
			// TODO: redirigir a página de error
			DB::rollBack();
			return back()->withErrors(['error_registro' => 'Hubo un error al registrarte: ' . $exception])->withInput();
		}

		Auth::login($user);
		$request->session()->regenerate();
		return redirect()->intended(route('home'));
		
	}
}
