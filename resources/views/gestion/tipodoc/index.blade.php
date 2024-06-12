@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Gestión de Tipos de Documento</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción del Tipo de Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiposDocumento as $tipo)
            <tr>
                <td>{{ $tipo->id_TipoDocumento }}</td>
                <td>{{ $tipo->TipoDocumento_desc }}</td>
                <td>
                    <a href="/gestion/tipos-documento/{{ $tipo->id_TipoDocumento }}/editar" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/tipos-documento/create" class="btn btn-primary">Añadir Nuevo Tipo de Documento</a>
</div>
@endsection
