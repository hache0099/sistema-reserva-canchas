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

class ProfileController extends Controller
{
    //

    function show()
    {
        $user = User::find(Auth::user()->id_usuario);
        $persona = $user->persona;
        $domicilio = $persona->domicilio->Domicilio_detalle;
        if(!$domicilio){
            echo 'no valido';
        }
        $dni = $persona->personadocumento->PersonaDocumento_desc;

        // $tipodni = TipoDocumento::where(
        //     'id_TipoDocumento', 
        //     $persona->personadocumento->TipoDocumento_id_TipoDocumento)
        //     ->first()
        //     ->TipoDocumento_desc;
        $tipodni = $persona->personadocumento->tipodocumento->TipoDocumento_desc;
        // $telefono = PersonaContacto::where('rela_persona', $persona->id_persona)
        // ->first()
        // ->PersonaContacto_desc;
        $telefono = $persona->personacontacto->first()->PersonaContacto_desc;

        return view('user.profile')
            ->with('user',$user)
            ->with('persona',$persona)
            ->with('tipodni', $tipodni)
            ->with('dni', $dni)
            ->with('domicilio', $domicilio)
            ->with('telefono', $telefono)
            ;
    }


    function updateProfile()
    {

    }
}
