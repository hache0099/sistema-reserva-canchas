@extends('layout.mainlayout')

@section('content')
<div class="container my-4">
    <h1>Añadir nuevo socio</h1>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuariosNoSocios as $usuario)
            <tr>
                <td>{{ $usuario->id_usuario }}</td>
                <td>{{ $usuario->persona->Nombre }} {{ $usuario->persona->Apellido }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    <!-- Formulario para hacer socio al usuario -->
                    <form action="{{ route('socio.hacerSocio', $usuario->id_usuario) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Hacer Socio</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No hay usuarios sin membresía.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

