@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Editar Tipo de Contacto</h1>
    <form action="/gestion/tipos-contacto/{{ $tipoContacto->idContacto }}/update" method="post">
        @csrf

        <div class="form-group">
            <label for="Contacto_descripcion">Descripción del Contacto:</label>
            <input type="text" class="form-control" id="Contacto_descripcion" name="Contacto_descripcion" value="{{ $tipoContacto->Contacto_descripcion }}" required>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="obligatorio" name="obligatorio" {{ $tipoContacto->obligatorio == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="obligatorio">Obligatorio</label>
        </div>

        <input type="submit" class="btn btn-primary" value="Guardar Cambios">
    </form>
</div>
@endsection

