<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocioController extends Controller
{
    //
    private function getUserPerfil($id = null) : string
    {
        $user_perfil = User::find(
            isset($id) ?
            $id :
            Auth::user()->id_usuario
            )
            ->perfil
            ->Perfil_descripcion;

        return $user_perfil;
    }

    function index()
    {
        $user_perfil = $this->getUserPerfil();

        if($user_perfil === "Usuario")
        {
            //TODO
        }

        $socios = User::with(["socio.estadomembresia","persona.personadocumento"])
            ->whereHas("socio")
            ->get();

        return view("gestion.socios.index", compact("socios"));
    }

    function show($socio)
    {

    }

    function store(Request $request)
    {

    }
}
