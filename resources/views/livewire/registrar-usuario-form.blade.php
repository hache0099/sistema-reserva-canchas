<div class="mt-4">
    <h3>Crear nuevo usuario</h3>
    <form wire:submit.prevent="saveUsuario">
        <div class="form-floating mb-3">
            <input class="form-control" placeholder="dni" type="number" id="dni" wire:model="dni" required>
            <label for="dni">DNI</label>
            @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" placeholder="nombre" type="text" id="nombre" wire:model="nombre" required>
            <label for="nombre">Nombre</label>
            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" placeholder="apellido" type="text" id="apellido" wire:model="apellido" required>
            <label for="apellido">Apellido</label>
            @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" placeholder="email" type="email" id="email" wire:model="email" required>
            <label for="email">Correo electrónico</label>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>

        @if (session()->has('message'))
            <div class="alert alert-success mt-2">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif
    </form>
</div>

