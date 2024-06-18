@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Editar Método de Pago</h1>
    <form action="/gestion/metodos-pago/{{$metodoPago->idMetodoPago}}/update" method="post">
        @csrf

        <div class="form-group">
            <label for="MetodoPago_Descripcion">Descripción del Método de Pago:</label>
            <input type="text" class="form-control" id="MetodoPago_Descripcion" name="MetodoPago_Descripcion" value="{{ $metodoPago->MetodoPago_Descripcion }}" required>
        </div>

        {{-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="estado" name="estado" {{ $metodoPago->estado == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="estado">Habilitado</label>
        </div> --}}

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection