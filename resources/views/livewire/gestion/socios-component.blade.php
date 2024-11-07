<div class="container my-4">
    <h1>Gestion de Socios</h1>
    <div class="row mb-3">
        <!--div class="col-md-6">
            <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar por DNI, Nombre o Apellido">
        </div-->
        <div class="col-md-6 text-right">
            <a role=button href="/gestion/socios/new" class="btn btn-primary">Añadir Nuevo Usuario</a>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th># Socio</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($socios as $socio)
            <tr>
                <td>{{ $socio->id_socio }}</td>
                <td>{{ $socio->usuario->persona->Nombre }}</td>
                <td>{{ $socio->usuario->persona->Apellido }}</td>
                <td>{{ $socio->usuario->persona->personadocumento->PersonaDocumento_desc }}</td>
                <td>{{ $socio->usuario->email }}</td>
                <td>
                    <a href="{{ route('pagos.pendientes', $socio->id_socio) }}" class="btn btn-info">
                        Ver Pagos Pendientes
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No se encontraron resultados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $socios->links() }}

    <!-- Modal para registrar pago -->
    @if($showModal)
        <livewire:gestion.registrar-pago-cuota :socioId="$selectedSocioId" :showModal="$showModal" />
    @endif
</div>

