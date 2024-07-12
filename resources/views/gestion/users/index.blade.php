@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Lista de Usuarios y Perfiles</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id_usuario }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->perfil->Perfil_descripcion }}</td>
                    <td>
                        <a href="/gestion/usuarios/{{ $usuario->id_usuario }}/editar" class="btn btn-warning btn-sm">Editar</a>
                     
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$usuarios->links()}}
</div>
@endsection