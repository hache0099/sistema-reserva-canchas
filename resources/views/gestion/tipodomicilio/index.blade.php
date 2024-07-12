@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Lista de Tipos de Domicilio</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('tipos-domicilio.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Tipo de Domicilio</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiposDomicilio as $tipoDomicilio)
                <tr>
                    <td>{{ $tipoDomicilio->idTipoDomicilio }}</td>
                    <td>{{ $tipoDomicilio->TipoDomicilio_desc }}</td>
                    <td>{{ $tipoDomicilio->estado ? 'Habilitado' : 'Deshabilitado' }}</td>
                    <td>
                        <a href="{{ route('tipos-domicilio.edit', $tipoDomicilio->idTipoDomicilio) }}" class="btn btn-primary">Editar</a>
                        <button 
                            class="btn btn-{{ $tipoDomicilio->estado == 1 ? "danger" : "success" }} btn-sm"
                            onclick="confirmChange('tipos-domicilio',{{ $tipoDomicilio->idTipoDomicilio }},{{ $tipoDomicilio->estado }});">
                            {{ $tipoDomicilio->estado == 1 ? "Eliminar" : "Restaurar" }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('custom-scripts')
<script src="{{asset('js/toggleElemento.js')}}" > </script>
@endsection