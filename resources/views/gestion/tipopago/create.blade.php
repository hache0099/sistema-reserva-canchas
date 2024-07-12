@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
        <h1>Crear Tipo de Pago</h1>
        <form action="{{ route('tipopago.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="TipoPago_desc">Descripción:</label>
                <input type="text" class="form-control" id="TipoPago_desc" name="TipoPago_desc" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="1">Habilitado</option>
                    <option value="0">Deshabilitado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

@endsection
