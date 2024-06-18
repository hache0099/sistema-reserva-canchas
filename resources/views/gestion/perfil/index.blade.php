@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Lista de Perfiles</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Perfil</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perfiles as $perfil)
                <tr>
                    <td>{{ $perfil->idPerfil }}</td>
                    <td>{{ $perfil->Perfil_descripcion }}</td>
                    <td>
                        <a href="/gestion/perfiles/{{$perfil->idPerfil}}/editar" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection