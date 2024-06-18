<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoContacto;

class TipoContactoController extends Controller
{
    //
    function index()
    {
        $tiposContacto = TipoContacto::all();

        return view('gestion.tipocontacto.index',['tiposContacto' => $tiposContacto]);
    }

    function edit(int $idTipoContacto)
    {
        $tipoContacto = TipoContacto::find($idTipoContacto);

        return view('gestion.tipocontacto.edit', ['tipoContacto' => $tipoContacto]);
    }

    function update(Request $request, int $idTipoContacto)
    {
        $request->validate([
            'Contacto_descripcion' => 'required|string',
            'obligatorio' => 'required',
        ]);
        
        $tipoContacto = TipoContacto::find($idTipoContacto);
        $obligatorio = 0;
        if(strtolower($request['obligatorio']) == 'on')
        {
            $obligatorio = 1;
        }

        $tipoContacto->Contacto_descripcion = $request['Contacto_descripcion'];
        $tipoContacto->obligatorio = $obligatorio;
        $tipoContacto->save();

        return redirect('/gestion/tipos-contacto')->with('status', 'Se ha actualizado correctamente');
    }

    function create()
    {
        return view('gestion.tipocontacto.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'Contacto_descripcion' => 'required|string',
            'obligatorio' => 'required',
        ]);

        TipoContacto::create([
            'Contacto_descripcion' => $request['Contacto_descripcion'],
            'obligatorio' => strtolower($request['obligatorio']) == 'on' ? 1 : 0,
        ]);

        return redirect('/gestion/tipos-contacto')->with('status','Se ha creado con exito');

    }

    function delete($idTipoContacto)
    {
        $tipoContacto = TipoContacto::find($idTipoContacto);
        $tipoContacto->estado = 0;
        $tipoContacto->save();

        return redirect('/gestion/tipos-contacto')->with('status','Se ha borrado con exito');
    }

    function restore($idTipoContacto)
    {
        $tipoContacto = TipoContacto::find($idTipoContacto);
        $tipoContacto->estado = 1;
        $tipoContacto->save();

        return redirect('/gestion/tipos-contacto')->with('status','Se ha restaurado con exito');
    }
}
