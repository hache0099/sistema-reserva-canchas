<?php

namespace App\Livewire\Gestion;

use Livewire\Component;

use App\Models\MedioPago;
use App\Models\MembresiaMes;
use App\Models\PagoMembresia;

class RegistrarPagoCuota extends Component
{
    public $socioId;
    public $montoPago;
    public $mes;
    public $anio;
    public $medioPago;
    public $membresiaMesId;

    public $showModal;
    
    protected $rules = [
        'montoPago' => 'required|numeric|min:1',
        'mes' => 'required|integer|between:1,12',
        'anio' => 'required|integer|min:2020',
        'medioPago' => 'required',
    ];

    public function mount($socioId, $showModal = true)
    {
        $this->socioId = $socioId;
        $this->showModal = $showModal;
    }

    public function savePayment()
    {
        $this->validate();

        // Obtener la membresía del mes que se va a registrar
        $membresiaMes = MembresiaMes::where('rela_socio', $this->socioId)
            ->where('mes', $this->mes)
            ->where('anio', $this->anio)
            ->first();

        if (!$membresiaMes) {
            $this->addError('membresia', 'No se encontró una membresía para el mes y año seleccionados.');
            return;
        }

        // Registrar el pago
        PagoMembresia::create([
            'Pago_fecha' => now(),
            'Pago_monto' => $this->montoPago,
            'rela_MembresiaMes' => $membresiaMes->idMembresiaMes,
            'rela_MedioPago' => $this->medioPago,
            'rela_EstadoPago' => 1, // Puedes cambiar este valor según el estado del pago
        ]);

        // Actualizar el monto pagado en MembresiaMes
        $membresiaMes->monto_pagado += $this->montoPago;
        $membresiaMes->save();

        session()->flash('success', 'Pago registrado correctamente.');
        
        // Emitir evento para cerrar el modal
        $this->emit('paymentRegistered');
    }

    public function render()
    {
        $mediosPago = MedioPago::all();
        
        return view('livewire.gestion.registrar-pago-cuota', [
            'mediosPago' => $mediosPago,
        ]);
    }
}
    

