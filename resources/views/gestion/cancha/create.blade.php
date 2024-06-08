@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Crear Nueva Cancha</h1>
    <form action="/gestion/canchas/guardar" method="post">
        @csrf

        <div class="form-group">
            <label for="Cancha_cantidad_max_personas">Cantidad Máxima de Personas:</label>
            <input type="number" class="form-control" id="Cancha_cantidad_max_personas" name="Cancha_cantidad_max_personas" required>
        </div>

        <div class="form-group">
            <label for="Cancha_precio_hora">Precio por Hora:</label>
            <input type="number" class="form-control" id="Cancha_precio_hora" name="Cancha_precio_hora" required>
        </div>

        <div class="form-group">
            <label for="rela_tipocancha">Tipo de Cancha:</label>
            <select class="form-control" id="rela_tipocancha" name="rela_tipocancha" required>
                @foreach($tiposCancha as $tipo)
                    <option value="{{ $tipo->idTipoCancha }}">{{ $tipo->Material }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Cancha</button>
    </form>
</div>
@endsection