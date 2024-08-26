@extends('layout.mainlayout')
@section('content')
 <div class="container my-4">
        <h1>Modificar Reserva</h1>
         @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
            
        <form action={{route("reserva.update", ["reserva" => $reserva])}} method="post">
            @csrf
            @method('put')
            
            <!-- Selección de la cancha -->
            <div class="form-group">
                <label for="cancha">Cancha Elegida:</label>
                <select class="form-control" id="cancha" name="id_cancha" required>
                    <option value="">Seleccionar Cancha</option>
                    @foreach($canchas as $cancha)
                        <option value="{{ $cancha->id_cancha }}" 
                        {{$reserva->cancha->id_cancha === $cancha->id_cancha ? "selected" : ""}}>
                        {{$cancha->tipocancha->Material}}, {{ $cancha->Cancha_cantidad_max_personas }} personas, 
                        Precio: ${{ $cancha->Cancha_precio_hora }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Selección de la fecha -->
            <div class="form-group">
                <label for="fecha">Fecha de Reserva:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value={{$reserva->Reserva_fecha}} required>
            </div>

            <!-- Checkboxes de las horas disponibles -->
            <div class="form-group">
                <label for="horas">Horas Disponibles:</label>
                <div id="horas-container" class="form-check">
                    <!-- Aquí se mostrarán las horas disponibles después de la solicitud AJAX -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

@endsection

@section('custom-scripts')
<script src={{asset('js/obtenerHorasDisponibles.js')}}></script>
<script>
    buscarHorarios();
    $('#cancha, #fecha').on('change', function() {
        buscarHorarios();
        
        if($("#cancha").val() === {{$reserva->cancha->id_cancha}} && $("#fecha").val() === "{{$reserva->Reserva_fecha}}"){
            var checkbox = `
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="hora{{$reserva->Reserva_hora}}" name="hora" value="{{$reserva->Reserva_hora}}" checked>
                            <label for="hora{{$reserva->Reserva_hora}}" class="form-check-label">{{$reserva->Reserva_hora}}:00 - {{$reserva->Reserva_hora+1}}:00</label>
                        </div>
                    `;
            $('#horas-container').append(checkbox);
        }
    });
</script>
@endsection