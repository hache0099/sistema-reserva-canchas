<?php

namespace App\Http\Controllers;

use App\Models\TipoCancha;
use Illuminate\Http\Request;

class TipoCanchaController extends Controller
{
    //

    function index()
    {
        $tiposCancha = TipoCancha::all();

        return view('gestion.tipocancha.index', ['tiposCancha' => $tiposCancha]);
    }

    function update(Request $request, $id_tipocancha)
    {
        $request->validate([
            'Material' => 'required|string',
        ]);

        $tipoCancha = TipoCancha::find($id_tipocancha);
        $tipoCancha->update($request->all());

        return redirect('/gestion/tipos-cancha')->with('status', 'Se ha actualizado con éxito');

    }

    function edit($id_tipocancha)
    {
        $tipoCancha = TipoCancha::find($id_tipocancha);

        return view('gestion.tipocancha.edit',['tipocancha' => $tipoCancha]);
    }

    function create()
    {
        return view('gestion.tipocancha.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'Material' => 'required|string',
        ]);

        TipoCancha::create($request->all());

        return redirect('/gestion/tipos-cancha')->with('status', 'Se ha creado con éxito');
    }

    function delete($id_tipocancha)
    {
        $tipoCancha = TipoCancha::find($id_tipocancha);
        $tipoCancha->estado = 0;
        $tipoCancha->save();

        return redirect('/gestion/tipos-cancha')->with('status', 'Se ha borrado con éxito');
    }

    function restore($id_tipocancha)
    {
        $tipoCancha = TipoCancha::find($id_tipocancha);
        $tipoCancha->estado = 1;
        $tipoCancha->save();
        return redirect('/gestion/tipos-cancha')->with('status', 'Se ha restaurado con éxito');
    }
}
