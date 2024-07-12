@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Gestión de Tipos de Documento</h1>
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción del Tipo de Documento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiposDocumento as $tipo)
            <tr>
                <td>{{ $tipo->id_TipoDocumento }}</td>
                <td>{{ $tipo->TipoDocumento_desc }}</td>
                <td>{{ $tipo->estado == 1 ? 'Habilitado' : 'Deshabilitado'}}</td>
                <td>
                    <a href="/gestion/tipos-documento/{{ $tipo->id_TipoDocumento }}/editar" class="btn btn-warning btn-sm">Editar</a>
                     <button 
                        class="btn btn-{{ $tipo->estado == 1 ? "danger" : "success" }} btn-sm"
                        onclick="confirmChange('tipos-documento',{{ $tipo->id_TipoDocumento  }},{{ $tipo->estado }});">
                        {{ $tipo->estado == 1 ? "Eliminar" : "Restaurar" }}
                    </button>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/gestion/tipos-documento/create" class="btn btn-primary">Añadir Nuevo Tipo de Documento</a>
</div>
<script>
    
</script>
@endsection
@section('custom-scripts')
    <script src="{{asset('js/toggleElemento.js')}}" > </script>
@endsection
