@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
        <h1>Editar Tipo de Pago</h1>
        <form action="{{ route('tipopago.update', $tipoPago->idTipoPago) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="TipoPago_desc">Descripción:</label>
                <input type="text" class="form-control" id="TipoPago_desc" name="TipoPago_desc" value="{{ $tipoPago->TipoPago_desc }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

@endsection
