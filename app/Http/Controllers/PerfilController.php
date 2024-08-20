<?php

namespace App\Http\Controllers;
use App\Models\Perfil;
use App\Models\Modulo;
use App\Models\PerfilModulo;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //

    function show()
    {
        $perfiles = Perfil::all();
        $perfilmodulo = PerfilModulo::all();
        //$modulo = Modulo::all();

        $perfilesConModulos = array();

        foreach($perfiles as $p)
        {
            $ids = $p->perfilmodulo->pluck('Modulo_idModulo')->toArray();
            $perfilesConModulos[$p] = Modulo::whereIn('idModulo',$ids);
        }

        return view('gestion.perfil.index',['perfiles' => $perfilesConModulos]);
    }

    function edit($id_perfil)
    {
        $perfil = Perfil::find($id_perfil);

        return view('gestion.perfil.edit',['perfil' => $perfil]);
    }
}
