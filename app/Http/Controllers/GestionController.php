<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Modulo;

use Illuminate\Support\Facades\Auth;

class GestionController extends Controller
{
    //
    function show()
    {
        $userPerfil = Auth::user()->perfil;

        $modulos = Modulo::whereHas('perfilmodulo', function($query) use ($userPerfil) {
            $query->where('Perfil_idPerfil', $userPerfil->idPerfil);
        })
        ->where('Modulo_ruta','like','/gestion/%')
        ->get();
        return view("gestion.index", compact('modulos'));
    }
}
