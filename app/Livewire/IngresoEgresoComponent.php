<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reserva;
use App\Models\IngresoEgreso;
use Carbon\Carbon;

class IngresoEgresoComponent extends Component
{
    public $reservas;
    public $reservaId;
    public $fechaElegida;
    public $tipoEvento;
    public $ingresoEgreso = []; // Mantendrá los eventos registrados

    public function mount()
    {
        // Inicialmente cargar todas las reservas
        $this->fechaElegida = now()->format('Y-m-d');
        $this->reservas = Reserva::with('cancha', 'user')
            ->where('Reserva_fecha', $this->fechaElegida)
            ->get();
        $this->tipoEvento = 'Ingreso'; // Por defecto
    }

    public function buscarReserva()
    {
        // Si se ingresa un ID, buscar solo esa reserva
        if ($this->reservaId) {
            $this->reservas = Reserva::where('id_reserva', $this->reservaId)
                ->with('cancha', 'user')
                ->get();
        } else {
            // Si no hay ID, mostrar todas las reservas
            $this->reservas = Reserva::with('cancha', 'user')->get();
        }
    }

    public function registrarEvento($reservaId)
    {
        // Registrar un nuevo evento de ingreso o egreso
        IngresoEgreso::create([
            'tipo_evento' => $this->tipoEvento,
            'fecha_hora' => Carbon::now(),
            'rela_reserva' => $reservaId,
        ]);

        // Actualizar lista de eventos registrados
        $this->ingresoEgreso = IngresoEgreso::where('rela_reserva', $reservaId)->get();
    }

    public function render()
    {
        return view('livewire.ingreso-egreso')
            ->extends('layout.mainlayout')
            ->section('content');
    }
}

