@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
        <h1>Lista de Tipos de Pago</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('tipopago.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Tipo de Pago</a>
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
                @foreach ($tiposPago as $tipoPago)
                    <tr>
                        <td>{{ $tipoPago->idTipoPago }}</td>
                        <td>{{ $tipoPago->TipoPago_desc }}</td>
                        <td>{{ $tipoPago->estado ? 'Habilitado' : 'Deshabilitado' }}</td>
                        <td>
                            <a href="{{ route('tipopago.edit', $tipoPago->idTipoPago) }}" class="btn btn-primary">Editar</a>
                            <button 
                                class="btn btn-{{ $tipoPago->estado == 1 ? "danger" : "success" }}"
                                onclick="confirmChange('tipos-pago',{{ $tipoPago->idTipoPago }},{{ $tipoPago->estado }});">
                                {{ $tipoPago->estado == 1 ? "Eliminar" : "Restaurar" }}
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
