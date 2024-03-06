<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //
    public function getPersona($id)
    {
		return Persona::findOrFail($id);
	}
	
	function store(Request $request){
		$persona = new Persona;
		
		$persona->Nombre = $request->name;
		$persona->Apellido = $request->apellido;
		$persona->DNI = $request->dni;
		$persona->Telefono = $request->telefono;
		$persona->rela_usuario = $request->id_usuario;
		
		$persona->save();
	}
}
