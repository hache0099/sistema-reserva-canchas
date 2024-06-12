@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Gestión de Horarios de Cancha</h1>
        <!-- Aviso de modificación exitosa -->
        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID Cancha</th>
                    <th>Hora Desde</th>
                    <th>Hora Hasta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de datos estáticos, reemplazar con datos dinámicos -->
                @foreach($horariosCancha as $horario)
                <tr>
                    <td>{{ $horario->rela_cancha }}</td>
                    <td>{{ $horario->hora_desde }}</td>
                    <td>{{ $horario->hora_hasta }}</td>
                    <td>
                        <a href="/gestion/horarios-cancha/{{ $horario->idHorarioCancha }}/editar" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/gestion/horarios-cancha/create" class="btn btn-primary">Añadir Nuevo Horario</a>
    </div>
@endsection

