<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Persona;
//use App\Models\Perfil;
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

class ProfileController extends Controller
{
    //

    private function obtenerInfoUsuario()
    {
        $user = User::find(Auth::user()->id_usuario);
        $persona = $user->persona;
        $domicilio = $persona->domicilio->Domicilio_detalle;
        $dni = $persona->personadocumento->PersonaDocumento_desc;
        $tipodni = $persona->personadocumento->tipodocumento->TipoDocumento_desc;
        $telefono = $persona->personacontacto->first()->PersonaContacto_desc;

        return array(
            'user' => $user,
            'persona' => $persona,
            'domicilio' => $domicilio,
            'dni' => $dni,
            'tipodni' => $tipodni,
            'telefono' => $telefono,
        );
    }

    function show()
    {
        $infoUsuario = $this->obtenerInfoUsuario();

        return view('user.profile', $infoUsuario);
    }


    function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
			'apellido' => 'required|string|max:45',
			'telefono' => 'required|numeric',
			'tipodni' => 'required|numeric|min:1',
			'dni' => 'required|numeric',
			'domicilio' => 'required|max:100',
			'fechanac' => 'required|date',
        ]);
        
        try{
        DB::beginTransaction();
        $user = User::find(Auth::user()->id_usuario);
        $persona = $user->persona;
        $domicilio = $persona->domicilio;
        $personadni = $persona->personadocumento;
        $telefono = $persona->personacontacto->first();
        
        //$user->email = $request['email'];
        $persona->Nombre = $request['nombre'];
        $persona->Apellido = $request['apellido'];
        $persona->FechaNacimiento = $request['fechanac'];
        $persona->save();
        
        $domicilio->Domicilio_detalle = $request['domicilio'];
        $domicilio->save();

        $personadni->PersonaDocumento_desc = $request['dni'];
        $personadni->TipoDocumento_id_Tipodocumento = $request['tipodni'];
        $personadni->save();

        $telefono->PersonaContacto_desc = $request['telefono'];
        $telefono->save();

        DB::commit();

        return redirect('/profile')->with('status', 'Sus datos han sido modificados con éxito');

        } catch (Throwable $e){
            DB::rollBack();
            return back()->withErrors('Error al actualizar: ' . $e)->withInput();
        }
    }

    function edit(Request $request)
    {
        $infoUsuario = $this->obtenerInfoUsuario();
        $tiposdni = TipoDocumento::all();

        $infoUsuario['tiposdni'] = $tiposdni;

        return view('user.editprofile', $infoUsuario);
    }
}
