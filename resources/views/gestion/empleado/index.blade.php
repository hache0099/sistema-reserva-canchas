@extends('layout.mainlayout')
@section('title', 'Listado de Empleados')
@section('content')

<div class="container my-4">
    <h1 class="text-center">Listado de Empleados</h1>
    
    <!-- Tabla de empleados -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID Empleado</th>
                    <th>Código de Legajo</th>
                    <th>Fecha de Alta</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Verificado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->idEmpleado }}</td>
                    <td>{{ $empleado->codigo_legajo }}</td>
                    <td>{{ $empleado->fecha_alta_empleado }}</td>
                    <td>{{ $empleado->usuario->email }}</td>
                    <td>{{ $empleado->usuario->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td>{{ $empleado->usuario->verificado ? 'Sí' : 'No' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('custom-scripts')
<script>
    // Aquí puedes agregar lógica JavaScript si es necesario
</script>
@endsection
