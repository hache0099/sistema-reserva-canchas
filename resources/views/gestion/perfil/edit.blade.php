@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Editar Perfil</h1>
        <form action="/gestion/perfiles/{{$perfil->idPerfil}}/update" method="post">
            @csrf

            <div class="form-group">
                <label for="Perfil_descripcion">Descripción del Perfil:</label>
                <input type="text" class="form-control" id="Perfil_descripcion" name="Perfil_descripcion" value="{{ $perfil->Perfil_descripcion }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
            <a href="/gestion/perfiles" role="button" class="btn btn-danger">Cancelar</a>
    </div>
@endsection