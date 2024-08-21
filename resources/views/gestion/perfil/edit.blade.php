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

            @foreach($modulo as $m)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="perfilmodulo[]" value="{{$m->idModulo}}" {{in_array($m->idModulo,$perfilmodulo) ? "checked" : ""}}>
                    <label class="form-check-label">{{$m->Modulo_descripcion}}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
            <a href="/gestion/perfiles" role="button" class="btn btn-danger">Cancelar</a>
    </div>
@endsection