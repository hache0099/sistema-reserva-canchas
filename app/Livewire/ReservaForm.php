<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\Auth;

use App\Models\Reserva;
use App\Models\Cancha;
use App\Models\PersonaDocumento;


class ReservaForm extends Component
{
    public $user_perfil = '';
    public $canchas;
    public $usuario;
    public $horarios;


    #[Validate('nullable|text')]
    public $dni = '';
    #[Validate('required|int')]
    public $canchaElegida;
    #[Validate('required|date')]
    public $fecha;
    #[Validate('required|int')]
    public $horaElegida;

    function mount()
    {
        $this->test = '';
        $this->canchas = Cancha::all();
        $this->user_perfil = Auth::user()->perfil->Perfil_descripcion;
        $this->fecha = now()->format('Y-m-d');
        $this->horarios = collect([]);
    }


    function buscarHorarios()
    {
        
        if(isset($this->fecha) && isset($this->canchaElegida))
        {
            $cancha = Cancha::find($this->canchaElegida);
            $canchaHorario = $cancha->canchahorario;
            $horasCancha = collect([]);
            for (
                $hora = $canchaHorario->hora_desde;
                $hora <= $canchaHorario->hora_hasta;
                $hora++
            ) {
                $horasCancha->push($hora);
            }

            $horasOcupadas = Reserva::where("Reserva_fecha", $this->fecha)
                ->get()
                ->reject(function ($reserva) {
                    return $reserva->reservaestado->ReservaEstado_descripcion ==
                        "Cancelada";
                })
                ->pluck("Reserva_hora");
            $horasDisponibles = $horasCancha->diff($horasOcupadas);

            $this->horarios = $horasDisponibles;
        }
    }


    function buscarUsuarioPorDNI()
    {
        $this->usuario = PersonaDocumento::where('PersonaDocumento_desc', $this->dni)
        ->with('persona.usuario')
        ->first();
    }


    function save()
    {
        $this->validate();
        $usuario = null;
        if(isset($this->dni))
        {
            if(User::find(Auth::user()->id_usuario)->perfil
                ->Perfil_descripcion === "usuario")
            {
                return response("No autorizado",403);
            }

            $usuario = PersonaDocumento::where('PersonaDocumento_desc',$this->dni)
                ->first()
                ->persona
                ->usuario;
        }
        $cancha = Cancha::where('id_cancha', $this->canchaElegida)
            ->with("precioActual")
            ->first();

        Reserva::create([
            "Reserva_fecha" => $this->fecha,
            "Reserva_hora" => $this->horaElegida,
            "monto_total" => $cancha->precioActual->precio, //TODO: agregar posibles descuentos
            "rela_usuario" => isset($usuario)
                ? $usuario->id_usuario
                : Auth::user()->id_usuario,
            "rela_cancha" => $this->canchaElegida,
            "rela_PorcentajeSena" => 1,
        ]);

        return redirect()->route("reserva.index");

    }

    
    public function render()
    {
        return view('livewire.reserva-form')
            ->extends('layout.mainlayout')
            ->section('content');
    }
}
