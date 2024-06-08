@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Gestión de Tipos de Cancha</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Material</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiposCancha as $tipo)
            <tr>
                <td>{{ $tipo->idTipoCancha }}</td>
                <td>{{ $tipo->Material }}</td>
                <td>
                    <a href="/tipos-cancha/{{ $tipo->idTipoCancha }}/editar" class="btn btn-warning btn-sm">Editar</a>
                    <a href="/tipos-cancha/{{ $tipo->idTipoCancha }}/eliminar" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/tipos-cancha/create" class="btn btn-primary">Crear Nuevo Tipo de Cancha</a>
</div>
@endsection