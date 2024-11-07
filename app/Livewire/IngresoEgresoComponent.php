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
    public $eventosPorReserva = []; // Mantendrá los eventos de cada reserva

    public function mount()
    {
        // Inicialmente cargar todas las reservas del día actual
        $this->fechaElegida = now()->format('Y-m-d');
        $this->cargarReservas();
        $this->tipoEvento = 'Ingreso'; // Evento por defecto
    }

    // Función para cargar todas las reservas con eventos de ingreso/egreso
    public function cargarReservas()
    {
        $this->reservas = Reserva::with('cancha', 'user')
            ->where('Reserva_fecha', $this->fechaElegida)
            ->get();

        // Cargar los eventos de ingreso/egreso para cada reserva
        foreach ($this->reservas as $reserva) {
            $this->eventosPorReserva[$reserva->id_reserva] = IngresoEgreso::where('rela_reserva', $reserva->id_reserva)->get();
        }
    }

    // Función para buscar reservas por ID
    public function buscarReserva()
    {
        if ($this->reservaId) {
            $this->reservas = Reserva::where('id_reserva', $this->reservaId)
                ->with('cancha', 'user')
                ->get();

            // Cargar los eventos de ingreso/egreso para la reserva buscada
            $this->eventosPorReserva[$this->reservaId] = IngresoEgreso::where('rela_reserva', $this->reservaId)->get();
        } else {
            // Si no hay un ID, cargar todas las reservas
            $this->cargarReservas();
        }
    }

    // Función para registrar un nuevo evento (Ingreso o Egreso)
    public function registrarEvento($reservaId)
    {
        IngresoEgreso::create([
            'tipo_evento' => $this->tipoEvento,
            'fecha_hora' => Carbon::now(),
            'rela_reserva' => $reservaId,
        ]);

        // Actualizar los eventos de la reserva actual
        $this->eventosPorReserva[$reservaId] = IngresoEgreso::where('rela_reserva', $reservaId)->get();
    }

    public function render()
    {
        return view('livewire.ingreso-egreso')
            ->extends('layout.mainlayout')
            ->section('content');
    }
}

