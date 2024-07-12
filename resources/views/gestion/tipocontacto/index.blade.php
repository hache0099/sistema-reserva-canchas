@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Gestión de Tipos de Contacto</h1>
        
        <!-- Aviso de modificación exitosa -->
        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID Contacto</th>
                    <th>Descripción del Contacto</th>
                    <th>Obligatorio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach($tiposContacto as $contacto)
                <tr>
                    <td>{{ $contacto->idContacto }}</td>
                    <td>{{ $contacto->Contacto_descripcion }}</td>
                    <td>{{ $contacto->obligatorio == 1 ? 'Sí' : 'No' }}</td>
                    <td>{{ $contacto->estado == 1 ? 'Habilitado' : 'Deshabilitado' }}</td>
                    <td>
                        <a href="/gestion/tipos-contacto/{{ $contacto->idContacto }}/editar" class="btn btn-warning btn-sm">Editar</a>
                         <button 
                            class="btn btn-{{ $contacto->estado == 1 ? "danger" : "success" }} btn-sm"
                            onclick="confirmChange('tipos-contacto',{{ $contacto->idContacto}},{{ $contacto->estado }});">
                            {{ $contacto->estado == 1 ? "Eliminar" : "Restaurar" }}
                        </button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/tipos-contacto/create" class="btn btn-primary">Añadir Nuevo Tipo de Contacto</a>
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

