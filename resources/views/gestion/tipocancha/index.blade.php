@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Gestión de Tipos de Cancha</h1>
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
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
                    <a href="/gestion/tipos-cancha/{{ $tipo->idTipoCancha }}/editar" class="btn btn-warning btn-sm">Editar</a>
                    
                    <button 
                        class="btn btn-{{ $tipo->estado == 1 ? "danger" : "success" }} btn-sm"
                        onclick="confirmChange('tipos-cancha',{{ $tipo->idTipoCancha }},{{ $tipo->estado }});">
                        {{ $tipo->estado == 1 ? "Eliminar" : "Restaurar" }}
                    </button>
                    
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/gestion/tipos-cancha/create" class="btn btn-primary">Crear Nuevo Tipo de Cancha</a>
</div>
<script>
    function confirmChange(elemento, id, toDelete) {
        let str = toDelete == 1 ? "borrar" : "restaurar";
        let finUrl = toDelete == 1 ? "delete" : "restore";
        if (confirm('¿Estás seguro de que deseas ' + str +' este elemento?')) {
            window.location.href = `/gestion/${elemento}/${id}/${finUrl}`;
        }
    }
</script>
@endsection