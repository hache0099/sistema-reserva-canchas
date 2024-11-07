<div class="container my-4">
    <h1>Agregar nuevo empleado</h2>
    <!-- Mensajes de éxito o error -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Opciones para añadir empleado -->
    <div class="mb-4">
        <button wire:click="crearNuevoUsuario" class="btn btn-primary">Crear Nuevo Usuario</button>
    </div>

    <!-- Barra de búsqueda -->
    <!--div class="mb-3">
        <input type="text" wire:model="search" placeholder="Buscar por DNI" class="form-control">
    </div-->

    <!-- Tabla de usuarios existentes -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->dni }}</td>
                    <td>{{ $usuario->Nombre }}</td>
                    <td>{{ $usuario->Apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <button wire:click="agregarEmpleado({{ $usuario->id_usuario }})" class="btn btn-success">Añadir Empleado</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron usuarios con ese DNI</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

