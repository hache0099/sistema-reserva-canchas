@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Editar Perfil del Usuario</h1>
        <form action="/gestion/usuarios/{{$usuario->id_usuario}}/updatePermisos" method="post">
            @csrf

            <div class="form-group">
                <label for="perfil">Perfil:</label>
                <select class="form-control" id="perfil" name="rela_perfil" required>
                    @foreach ($perfiles as $perfil)
                        <option value="{{ $perfil->idPerfil }}" {{ $perfil->idPerfil == $usuario->rela_perfil ? 'selected' : '' }}>
                            {{ $perfil->Perfil_descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
@endsection

