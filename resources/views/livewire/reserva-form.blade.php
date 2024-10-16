<div class="container my-4">
    <h1>Crear nueva reserva</h1>
    <form wire:submit.prevent="save"> <!-- Cambié 'submit=save' a 'submit.prevent' para evitar comportamiento no deseado -->

        @if($user_perfil !== "usuario")
            <div class="form-group">
                <label for="dni">DNI del usuario</label>
                <input class="form-control" wire:model="dni" id="dni" type="number" name="dni">
                
                <!-- Botón para buscar usuario -->
                <button type="button" class='btn btn-sm btn-secondary' wire:click="buscarUsuarioPorDNI">Buscar Usuario</button>
            
                <!-- Mostrar detalles del usuario si está disponible -->
                @if($usuario !== null)
                    <span class="d-block mt-2">Nombre: {{$usuario->persona->Nombre}} {{$usuario->persona->Apellido}}</span>
                    <span class="d-block">ID Usuario: {{$usuario->persona->usuario->id_usuario}}</span>
                @else
                    <livewire:registrar-usuario-form perfil="usuario" />
                @endif
            </div>
        @endif

        <div class="form-group">
            <label for="cancha">Cancha Elegida:</label>
            <select wire:model="canchaElegida" wire:change="buscarHorarios" class="form-control" id="cancha" name="id_cancha" required>
                <option value="">Seleccionar Cancha</option>
                @foreach($canchas as $cancha)
                    <div wire:key="{{$cancha->id_cancha}}">
                        <option value="{{ $cancha->id_cancha }}">
                            {{$cancha->tipocancha->Material}}, {{ $cancha->Cancha_cantidad_max_personas }} personas, Precio: ${{ $cancha->precioActual->precio }}
                        </option>
                    </div>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de Reserva:</label>
            <input type="date" wire:model="fecha" wire:change="buscarHorarios" class="form-control" id="fecha" name="fecha" required>
        </div>

        <div class="form-group">
            <label for="horas">Horas Disponibles:</label>
            <div id="horas-container" wire:model="horarios" class="form-check">
                @if(!empty($horarios))
                    @foreach($horarios as $hora)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="{{$hora}}" name="hora" id="hora-{{$hora}}">
                            <label class="form-check-label" for="hora-{{$hora}}">
                                {{$hora}}:00 - {{$hora + 1}}:00
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Reservar">
    </form>
</div>

