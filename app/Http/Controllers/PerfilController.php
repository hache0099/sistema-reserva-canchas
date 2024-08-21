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
        $perfiles = Perfil::with('perfilmodulo')->get();

        return view('gestion.perfil.index',compact('perfiles'));
    }

    function edit($id_perfil)
    {
        $perfil = Perfil::find($id_perfil);
        $modulo = Modulo::all();
        $perfilmodulo = PerfilModulo::where('Perfil_idPerfil', $perfil->idPerfil)->pluck('Modulo_idModulo')->toArray();

        return view('gestion.perfil.edit',compact('perfil', 'modulo','perfilmodulo'));
    }

    function update(Request $request, $idPerfil)
    {
        $request->validate([
            'Perfil_descripcion' => 'required|string',
            'perfilmodulo' => 'required|array',
        ]);

        $perfil = Perfil::find($idPerfil);

        PerfilModulo::destroy($perfil->perfilmodulo->modelKeys());

        //TODO: terminar la actualizacion de los modulos

    }
}
