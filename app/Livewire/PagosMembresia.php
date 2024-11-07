<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MembresiaMes; // Modelo que contiene los pagos pendientes
use App\Models\PagoMembresia;

class PagosMembresia extends Component
{
    public $socioId;
    public $pagos = [];
    public $verSoloPendientes = true;  // Controlar si se ven solo pagos pendientes o todos
    public $pagoSeleccionado;
    public $showModal = false;
    public $montoPago;

    public function mount($socioId)
    {
        $this->socioId = $socioId;
        $this->cargarPagos();
    }

    // Cargar los pagos dependiendo de la opción seleccionada
    public function cargarPagos()
    {
        $query = MembresiaMes::where('rela_socio', $this->socioId);
        
        if ($this->verSoloPendientes) {
            $query->where('monto_pagado', '<', 'monto_a_pagar');
        }

        $this->pagos = $query->get();
    }

    // Alternar entre mostrar solo pagos pendientes o todos
    public function toggleVerSoloPendientes()
    {
        $this->verSoloPendientes = !$this->verSoloPendientes;
        $this->cargarPagos();
    }

    // Abrir el modal para registrar el pago
    public function abrirModal($pagoId)
    {
        $this->pagoSeleccionado = MembresiaMes::find($pagoId);
        $this->showModal = true;
    }

    // Registrar el pago
    public function registrarPago()
    {
        if ($this->montoPago <= ($this->pagoSeleccionado->monto_a_pagar - $this->pagoSeleccionado->monto_pagado)) {
            PagoMembresia::create([
                'Pago_fecha' => now(),
                'Pago_monto' => $this->montoPago,
                'rela_MembresiaMes' => $this->pagoSeleccionado->idMembresiaMes,
                'rela_MedioPago' => 1, // Medio de pago por defecto
            ]);

            $this->pagoSeleccionado->monto_pagado += $this->montoPago;
            $this->pagoSeleccionado->save();

            session()->flash('message', 'Pago registrado con éxito.');
            $this->showModal = false;
            $this->cargarPagos();
        } else {
            session()->flash('error', 'El monto ingresado excede el monto pendiente.');
        }
    }

    public function render()
    {
        return view('livewire.pagos-membresia')
            ->extends('layout.mainlayout')
            ->section('content');
    }
}
