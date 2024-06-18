@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Editar Tipo de Cancha</h1>
    <form action="/gestion/tipos-cancha/{{$tipocancha->idTipoCancha}}/update" method="post">

        @csrf

        <div class="form-group">
            <label for="Material">Material:</label>
            <input type="text" class="form-control" id="Material" name="Material" value="{{ $tipocancha->Material }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
    <a href="/gestion/tipos-cancha" role="button" class="btn btn-danger">Cancelar</a>
</div>
@endsection