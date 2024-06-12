<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HorarioCancha;

class HorarioCanchaController extends Controller
{
    //
    function index()
    {
        $horaCancha = HorarioCancha::all();

        return view('gestion.horacancha.index',['horariosCancha' => $horaCancha]);
    }

    public function create()
    {
        return view('gestion.horacancha.create');
    }

    function edit(int $idHorarioCancha)
    {
        $horaCancha = HorarioCancha::find($idHorarioCancha);

        return view('gestion.horacancha.edit',['horario' => $horaCancha]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            // 'rela_cancha' => 'required',
            'hora_desde' => 'required|int',
            'hora_hasta' => 'required|int',
        ]);

        $horario = HorarioCancha::find($id);
        $horario->update($request->all());

        return redirect('/gestion/horarios-canchas')->with('status', 'Horario de cancha actualizado exitosamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rela_cancha' => 'required',
            'hora_desde' => 'required|int',
            'hora_hasta' => 'required|int',
        ]);

        HorarioCancha::create($request->all());

        return redirect()->route('horarios-cancha.index')->with('success', 'Horario de cancha creado exitosamente.');
    }
}
