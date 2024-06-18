@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
        <h1>Lista de Métodos de Pago</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($metodosPago as $metodoPago)
                    <tr>
                        <td>{{ $metodoPago->MetodoPago_Descripcion }}</td>
                        <td>{{ $metodoPago->estado ? 'Habilitado' : 'Deshabilitado' }}</td>
                        <td>
                            <a href="/gestion/metodos-pago/{{$metodoPago->idMetodoPago}}/editar" class="btn btn-primary">Editar</a>
                           <button 
                                class="btn btn-{{ $metodoPago->estado == 1 ? "danger" : "success" }} btn-sm"
                                onclick="confirmChange('metodos-pago',{{ $metodoPago->idMetodoPago }},{{ $metodoPago->estado }});">
                                {{ $metodoPago->estado == 1 ? "Deshabilitar" : "Habilitar" }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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