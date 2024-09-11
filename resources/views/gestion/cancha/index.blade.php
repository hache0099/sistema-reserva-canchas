@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Gestión de Canchas</h1>
    <!-- Aviso de modificación exitosa -->
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <a href="/gestion/canchas/create" class="btn btn-primary">Crear Nueva Cancha</a>
    <a href="/gestion/canchas/editarPrecios" class="btn btn-primary">Actualizar precios</a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID Cancha</th>
                <th>Tipo de Cancha</th>
                <th>Cantidad Máxima de Personas</th>
                <th>Precio por Hora</th>

                <th>Acciones</th>
            </tr>
        </thead>
            @foreach($canchas as $cancha)
            <tr>

                <td>{{ $cancha->id_cancha }}</td>
                <td>{{ $cancha->tipocancha->Material }}</td>
                <td>{{ $cancha->Cancha_cantidad_max_personas }}</td>
                <td>${{ $cancha->precioActual->precio }}</td>

                <td>
                    <a href="/gestion/canchas/{{ $cancha->id_cancha }}/editar" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
