@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Editar Cancha {{ $cancha->id_cancha }}</h1>
    <form action="/gestion/canchas/{{ $cancha->id_cancha }}/update" method="post">
        @csrf

        {{-- <div class="form-group">
            <label for="id_cancha">ID Cancha:</label>
            <input type="text" class="form-control" id="id_cancha" name="id_cancha" value="{{ $cancha->id_cancha }}" readonly>
        </div> --}}

        <div class="form-group">
            <label for="Cancha_cantidad_max_personas">Cantidad Máxima de Personas:</label>
            <input type="number" class="form-control" id="Cancha_cantidad_max_personas" name="Cancha_cantidad_max_personas" value="{{ $cancha->Cancha_cantidad_max_personas }}">
        </div>

        <div class="form-group">
            <label for="Cancha_precio_hora">Precio por Hora:</label>
            <input type="number" class="form-control" id="Cancha_precio_hora" name="Cancha_precio_hora" value="{{ $cancha->precioActual->precio }}">
        </div>

        <div class="form-group">
            <label for="rela_tipocancha">Tipo de Cancha:</label>
            <select class="form-control" id="rela_tipocancha" name="rela_tipocancha">
                @foreach($tiposCancha as $tipo)
                    <option value="{{ $tipo->idTipoCancha }}" {{ $tipo->idTipoCancha == $cancha->rela_tipocancha ? 'selected' : '' }}>{{ $tipo->Material }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
