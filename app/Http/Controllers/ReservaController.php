<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cancha;
use App\Models\User;
use App\Models\PersonaDocumento;
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

        $reservas = $user->reservas->reject(function ($reserva) {
            return ($reserva->Reserva_fecha < date("Y-m-d") &&
                $reserva->Reserva_hora > date("H")) ||
                $reserva->reservaestado->ReservaEstado_descripcion ==
                    "Cancelada";
        });

        return view("reserva.index", ["reservas" => $reservas]);
    }

    function gestionIndex()
    {
        return view('gestion.reservas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $canchas = Cancha::all();
        $user_perfil = User::find(Auth::user()->id_usuario)->perfil
            ->Perfil_descripcion;
        return view("reserva.create", compact("canchas", "user_perfil"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "id_cancha" => "required|int",
            "fecha" => "required|date",
            "hora" => "required|int",
            "dni" => "nullable|int",
        ]);
        $usuario = null;
        if(isset($request->dni))
        {
            if(User::find(Auth::user()->id_usuario)->perfil
                ->Perfil_descripcion === "usuario")
            {
                return response("No autorizado",403);
            }

            $usuario = PersonaDocumento::where('PersonaDocumento_desc',$request->dni)
                ->first()
                ->persona
                ->usuario;
        }
        $cancha = Cancha::where('id_cancha', $request->id_cancha)
            ->with("precioActual")
            ->first();

        Reserva::create([
            "Reserva_fecha" => $request->fecha,
            "Reserva_hora" => $request->hora,
            "monto_total" => $cancha->precioActual->precio, //TODO: agregar posibles descuentos
            "rela_usuario" => isset($usuario)
                ? $usuario->id_usuario
                : Auth::user()->id_usuario,
            "rela_cancha" => $request->id_cancha,
            "rela_PorcentajeSena" => 1,
        ]);

        return redirect()->route("reserva.index");
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
        $userPerfil = User::find(Auth::user()->id_usuario)->perfil
            ->Perfil_descripcion;

        if ($userPerfil === "usuario") {
            if ($reserva->user->id_usuario != Auth::user()->id_usuario) {
                return response("No Autorizado", 403);
            }
        }

        $canchas = Cancha::all();

        return view("reserva.edit", compact("reserva", "canchas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
        $request->validate([
            "id_cancha" => "required|int",
            "fecha" => "required|date",
            "hora" => "required|int",
            // 'dni' => 'int',
        ]);

        $reserva->rela_cancha = $request->id_cancha;
        $reserva->Reserva_fecha = $request->fecha;
        $reserva->Reserva_hora = $request->hora;

        $reserva->save();

        return redirect()->route("reserva.index");
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
            "id_cancha" => "required|int",
            "fecha" => "required|date",
        ]);

        $id_cancha = $request->id_cancha;
        $fecha = $request->fecha;

        $cancha = Cancha::find($id_cancha);
        $canchaHorario = $cancha->canchahorario;

        $horasCancha = collect([]);
        for (
            $hora = $canchaHorario->hora_desde;
            $hora <= $canchaHorario->hora_hasta;
            $hora++
        ) {
            $horasCancha->push($hora);
        }

        $horasOcupadas = Reserva::where("Reserva_fecha", $fecha)
            ->get()
            ->reject(function ($reserva) {
                return $reserva->reservaestado->ReservaEstado_descripcion ==
                    "Cancelada";
            })
            ->pluck("Reserva_hora");
        $horasDisponibles = $horasCancha->diff($horasOcupadas);

        return json_encode(array_values($horasDisponibles->toArray()));
    }

    public function buscarReservas(Request $request)
    {
        $request->validate([
            'fecha' => 'date',
            'pendientes' => 'boolean',
        ]);
        
        $fecha = $request->input('fecha');
        $verPendientes = $request->input('pendientes');

        // Validar que la fecha esté presente
        if (!$fecha) {
            return response()->json([], 400);  // Devuelve un error si la fecha no está presente
        }

        // Consulta para obtener las reservas según la fecha y estado de pago
        $reservas = Reserva::with(['cancha','user.persona.personadocumento','estadopago','ingresoegreso'])
            ->where('Reserva_fecha',$fecha)
            ->orderBy("Reserva_fecha");

        // Filtrar por reservas pendientes si el checkbox está marcado
        if ($verPendientes) {
            $reservas->where('rela_EstadoPago',1);
        }

        // Obtener los resultados ordenados por hora
        //$reservas = $query->orderBy('Reserva.Reserva_hora')->get();

        // Devolver los resultados en formato JSON
        return response()->json($reservas->get());
    }

}
