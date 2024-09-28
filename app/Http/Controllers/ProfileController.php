<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Persona;
use App\Models\Perfil;
use App\Models\TipoDocumento;
use App\Models\TipoContacto;
use App\Models\PersonaContacto;
use App\Models\PersonaDocumento;
use App\Models\Domicilio;
use App\Models\TipoDomicilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProfileController extends Controller
{
    //

    private function obtenerInfoUsuario($id_usuario = null)
    {
        $user = User::find(isset($id_usuario) ? $id_usuario : Auth::user()->id_usuario);
        $persona = $user->persona;
        $domicilio = $persona->domicilio->Domicilio_detalle;
        $tipoDomicilio = $persona->domicilio->tipodomicilio->TipoDomicilio_desc;
        $dni = $persona->personadocumento->PersonaDocumento_desc;
        $tipodni = $persona->personadocumento->tipodocumento->TipoDocumento_desc;
        $telefono = $persona->personacontacto->first()->PersonaContacto_desc;
        //$perfil = $user->perfil;
        

        return array(
            'user' => $user,
            'persona' => $persona,
            'domicilio' => $domicilio,
            'tipodomicilio' => $tipoDomicilio,
            'dni' => $dni,
            'tipodni' => $tipodni,
            'telefono' => $telefono,
            //'perfil' => $perfil,
        );
    }

    function show()
    {
        $infoUsuario = $this->obtenerInfoUsuario();

        return view('user.profile', $infoUsuario);
    }


    function update(Request $request, $id=null)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
			'apellido' => 'required|string|max:45',
			'telefono' => 'required|numeric',
			'tipodni' => 'required|numeric|min:1',
			'dni' => 'required|numeric',
			'domicilio' => 'required|max:100',
			'fechanac' => 'required|date',
            'tipodomicilio' => 'numeric|min:1',
            'id_usuario' => 'numeric',
            'perfil' => 'numeric',
        ]);

        if(isset($request->editarOtroUsuario))
        {
            if(User::find(Auth::user()->id_usuario)->perfil->Perfil_descripcion == "Usuario")
            {
                return response("No Autorizado",403);
            }
        }
        try{
        DB::beginTransaction();
        $user = User::find(isset($id) ? $id : Auth::user()->id_usuario);
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
        $domicilio->rela_tipodomicilio = $request['tipodomicilio'];
        $domicilio->save();

        

        $personadni->PersonaDocumento_desc = $request['dni'];
        $personadni->TipoDocumento_id_Tipodocumento = $request['tipodni'];
        $personadni->save();

        $telefono->PersonaContacto_desc = $request['telefono'];
        $telefono->save();

        if(isset($request->perfil))
        {
            $user->rela_perfil = $request->perfil;
            $user->save();
        }

        DB::commit();

        if(!isset($request->editarOtroUsuario))
        {
            return redirect('/profile')->with('status', 'Sus datos han sido modificados con éxito');
        }
        return redirect('/gestion/usuarios')->with('status', 'Los datos han sido modificados con éxito');
        } catch (Throwable $e){
            DB::rollBack();
            return back()->withErrors('Error al actualizar: ' . $e)->withInput();
        }
    }

    function edit($id = null)
    {
        if(isset($id))
        {
            if(User::find(Auth::user()->id_usuario)->perfil->Perfil_descripcion === "usuario" 
                && $id !== Auth::user()->id_usuario)
            {
                return response("No Autorizado",403);
            }
        }
        
        $infoUsuario = $this->obtenerInfoUsuario($id);
        $tiposdni = TipoDocumento::all();
        $tiposdomicilio = TipoDomicilio::all();

        $infoUsuario['tiposdni'] = $tiposdni;
        $infoUsuario['tiposdomicilio'] = $tiposdomicilio;

        $user = User::find(Auth::user()->id_usuario);
        if($user->perfil->Perfil_descripcion !== "usuario")
        {
            $infoUsuario['tiposperfil'] = Perfil::all()
                ->reject(function ($perfil) use ($user) { 
                    return $perfil->idPerfil < $user->perfil->idPerfil; 
                });
        }

        return view('user.editprofile', $infoUsuario);
    }
}
