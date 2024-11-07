<div class="container my-4">
    <h1>Pagos del Socio</h1>

    <!-- Mensajes de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Checkbox para mostrar todos los pagos o solo pendientes -->
    <div class="mb-3">
        <input type="checkbox" id="verSoloPendientes" wire:click="toggleVerSoloPendientes" @if($verSoloPendientes) checked @endif>
        <label for="verSoloPendientes">Ver solo pagos pendientes</label>
    </div>

    <!-- Listado de pagos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>Monto a Pagar</th>
                <th>Monto Pagado</th>
                <th>Pendiente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->mes }}</td>
                    <td>{{ $pago->anio }}</td>
                    <td>${{ number_format($pago->monto_a_pagar, 2) }}</td>
                    <td>${{ number_format($pago->monto_pagado, 2) }}</td>
                    <td>${{ number_format($pago->monto_a_pagar - $pago->monto_pagado, 2) }}</td>
                    <td>
                        @if($pago->monto_pagado < $pago->monto_a_pagar)
                            <!-- Botón para registrar pago si el monto pagado es menor al monto a pagar -->
                            <button class="btn btn-primary" wire:click="abrirModal({{ $pago->idMembresiaMes }})">
                                Registrar Pago
                            </button>
                        @else
                            <!-- Botón para ver comprobante si el pago está completo -->
                            <!--button class="btn btn-secondary">
                                Ver Comprobante
                            </button-->
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal de registro de pago -->
    @if($showModal)
        <div class="modal fade show" tabindex="-1" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Pago en Cuotas</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="$set('showModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="montoPago" class="form-label">Monto a Pagar</label>
                                <input type="number" step="0.01" min="0.00" placeholder="0.00" class="form-control" id="montoPago" wire:model="montoPago">
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="registrarPago">Registrar Pago</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal background overlay -->
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
