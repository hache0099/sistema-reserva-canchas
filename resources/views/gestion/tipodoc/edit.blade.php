@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Editar Tipo de Documento</h1>
    <form action="/gestion/tipos-documento/{{ $tipoDocumento->id_TipoDocumento }}/update" method="post">
        @csrf

        <div class="form-group">
            <label for="TipoDocumento_desc">Descripción del Tipo de Documento:</label>
            <input 
                type="text" 
                class="form-control" 
                id="TipoDocumento_desc" 
                name="TipoDocumento_desc" 
                value="{{ $tipoDocumento->TipoDocumento_desc }}" 
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection

