@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Crear Nuevo Tipo de Contacto</h1>
    <form action="/tipos-contacto" method="post">
        @csrf

        <div class="form-group">
            <label for="Contacto_descripcion">Descripción del Contacto:</label>
            <input type="text" class="form-control" id="Contacto_descripcion" name="Contacto_descripcion" required>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="obligatorio" name="obligatorio">
            <label class="form-check-label" for="obligatorio">Obligatorio</label>
        </div>

        <button type="submit" class="btn btn-primary">Crear Tipo de Contacto</button>
    </form>
</div>
@endsection
