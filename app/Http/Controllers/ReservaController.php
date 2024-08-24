<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cancha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        
        $reservas = $user->reservas->reject(function ($reserva){
            return (($reserva->Reserva_fecha < date('Y-m-d')) && 
                   ($reserva->Reserva_hora > date('H'))) ||
                   ($reserva->reservaestado->ReservaEstado_descripcion == "Cancelada"); 
        });
        
        return view('reserva.index', ['reservas' => $reservas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $canchas = Cancha::all();

        return view('reserva.create', compact('canchas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_cancha' => 'required|int',
            'fecha' => 'required|date',
            'hora' => 'required|int',
            'id_usuario' => 'int',
        ]);

        Reserva::create([
            'Reserva_fecha' => $request->fecha,
            'Reserva_hora' => $request->hora,
            'rela_usuario' => isset($request->id_usuario) ? $request->id_usuario : Auth::user()->id_usuario,
            'rela_cancha' => $request->id_cancha,
        ]);

        return redirect()->route('reserva.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
        $userPerfil = User::find(Auth::user()->id_usuario)->perfil->Perfil_descripcion;

        if ($userPerfil === "Usuario"){
            if ($reserva->user->id_usuario != Auth::user()->id_usuario){
                return response('No Autorizado', 403);
            }
        }

        $canchas = Cancha::all();

        return view('reserva.edit', compact('reserva','canchas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
        echo "no funca";
        $request->validate([
            'id_cancha' => 'required|int',
            'fecha' => 'required|date',
            'hora' => 'required|int',
            // 'id_usuario' => 'int',
        ]);

        $reserva->rela_cancha = $request->id_cancha;
        $reserva->Reserva_fecha = $request->fecha;
        $reserva->Reserva_hora = $request->hora;

        $reserva->save();

        return redirect()->route('reserva.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    /**
     * Para ser usado con métodos AJAX
     */
    function obtenerHorasDisponibles(Request $request)
    {
        $request->validate([
            'id_cancha' => 'required|int',
            'fecha' => 'required|date',
        ]);

        $id_cancha = $request->id_cancha;
        $fecha = $request->fecha;
        
        $cancha = Cancha::find($id_cancha);
        $canchaHorario = $cancha->canchahorario;

        $horasCancha = collect([]);
        for($hora = $canchaHorario->hora_desde; $hora <= $canchaHorario->hora_hasta; $hora++)
        {
            $horasCancha->push($hora);
        }

        $horasOcupadas = Reserva::where('Reserva_fecha',$fecha)
            ->get()
            ->reject(function ($reserva) {
                return $reserva->reservaestado->ReservaEstado_descripcion == "Cancelada";
            })
            ->pluck('Reserva_hora');
        $horasDisponibles = $horasCancha->diff($horasOcupadas);

        return json_encode(array_values($horasDisponibles->toArray()));
    }
}
