@extends('layout.mainlayout')
@section('title','Listado de usuarios')
@section('content')
<div class="container my-4">
    <h1>Lista de Usuarios y Perfiles</h1>
    <form action="" method="get" name="buscarUsuario" id="buscarUsuario">
        <div class="col-auto">
            <a href="/gestion/usuarios/create" role=button class="btn btn-primary">Crear usuario</a>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                <div class="form-floating">
                    <input type="text" class="form-control" name="q" id="q" placeholder="Buscar">
                    <label for="q" class="form-label">Buscar Usuario</label>
                </div>
            </div>
            <div class="col-auto">
                <select name="search_by" class="form-select">
                    <option selected>Buscar por</option>
                    <option value="id">ID</option>
                    <option value="dni">DNI</option>
                    <option value="email">Email</option>
                    <option value="nombre">Nombre</option>
                    <option value="apellido">Apellido</option>
                </select>
            </div>
        </div>
    </form>
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
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id_usuario }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->perfil->Perfil_descripcion ?? 'N/A' }}</td>
                    <td>
                        <a href="/gestion/usuarios/{{ $usuario->id_usuario }}/editar" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/gestion/usuarios/{{ $usuario->id_usuario }}/resetPassword" class="btn btn-warning btn-sm">Resetear contraseña</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No se encontraron usuarios.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($usuarios instanceof \Illuminate\Pagination\LengthAwarePaginator) <!-- Verifica si es una instancia paginada -->
        {{ $usuarios->links() }}
    @endif
</div>
@endsection

