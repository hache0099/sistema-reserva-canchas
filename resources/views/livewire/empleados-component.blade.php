<div class="container my-4">
    <h1>Gestion de Empleados</h1>
    <!-- Barra de búsqueda -->
    <!--input type="text" wire:model="search" placeholder="Buscar por DNI o Código de Legajo" class="form-control mb-3" /-->

    <!-- Botón para añadir nuevo empleado -->
    <button wire:click="crearEmpleado" class="btn btn-primary mb-3">Nuevo Empleado</button>

    <!-- Tabla de empleados -->
    <table class="table">
        <thead>
            <tr>
                <th>Código Legajo</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Alta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->codigo_legajo }}</td>
                    <td>{{ $empleado->dni }}</td>
                    <td>{{ $empleado->Nombre }}</td>
                    <td>{{ $empleado->Apellido }}</td>
                    <td>{{ $empleado->fecha_alta_empleado }}</td>
                    <td>
                        <!-- Aquí puedes añadir acciones, como ver detalles, editar o eliminar -->
                        <button class="btn btn-sm btn-info">Ver Detalles</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
