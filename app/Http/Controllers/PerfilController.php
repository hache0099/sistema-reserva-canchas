<?php

namespace App\Http\Controllers;
use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //

    function show()
    {
        $perfiles = Perfil::all();

        return view('gestion.perfil.index',['perfiles' => $perfiles]);
    }

    function edit($id_perfil)
    {
        $perfil = Perfil::find($id_perfil);

        return view('gestion.perfil.edit',['perfil' => $perfil]);
    }
}
