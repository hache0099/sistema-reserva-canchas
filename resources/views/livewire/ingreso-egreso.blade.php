<div class="container my-4">
    <h1>Control de Ingreso y Egreso</h1>

    <!-- Búsqueda por ID de Reserva -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Buscar reserva por ID" wire:model="reservaId">
        </div>
        <div class="col-md-2">
            <button wire:click="buscarReserva" class="btn btn-primary">Buscar</button>
        </div>
    </div>

    <!-- Tabla de Reservas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Reserva</th>
                <th>Cliente</th>
                <th>Cancha</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->id_reserva }}</td>
                    <td>{{ $reserva->user->email }}</td> <!-- Relación con usuario -->
                    <td>{{ $reserva->cancha->id_cancha }}</td> <!-- Relación con cancha -->
                    <td>{{ $reserva->getFecha() }}</td>
                    <td>{{ $reserva->Reserva_hora }}:00</td>
                    <td>{{ $reserva->Reserva_hora + 1 }}:00</td> <!-- Hora de fin simulada -->
                    <td>
                        <select wire:model="tipoEvento" class="form-select mb-2">
                            <option value="Ingreso">Marcar Ingreso</option>
                            <option value="Egreso">Marcar Egreso</option>
                        </select>
                        <button wire:click="registrarEvento({{ $reserva->id_reserva }})" class="btn btn-success">
                            Registrar {{ $tipoEvento }}
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <!-- Mostrar eventos de ingreso/egreso -->
                        <ul>
                            @foreach($ingresoEgreso as $evento)
                                <li>{{ $evento->tipo_evento }} registrado en {{ $evento->fecha_hora }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No se encontraron reservas para el ID especificado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

