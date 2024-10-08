@extends('layout.mainlayout')
@section('title', 'Control de Ingresos y Egresos')
@section('content')
<div class="container my-4">
    <h1>Control de Ingresos y Egresos</h1>

    <!-- Filtro por Fecha y Cancha -->
    <form id="filtroIngresosEgresos">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="date" class="form-control" id="fechaReserva" name="fechaReserva" required>
            </div>
            <div class="col-md-4">
                <select id="canchaSeleccionada" class="form-select" name="canchaSeleccionada">
                    <option selected disabled>Seleccionar Cancha</option>
                    <!-- Opciones de canchas -->
                </select>
            </div>
            <div class="col-md-4">
                <button type="button" id="buscarReservas" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>
@endsection
