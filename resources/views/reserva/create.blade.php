@extends('layout.mainlayout')
@section('content')
 <div class="container my-4">
        <h1>Crear Nueva Reserva</h1>
         @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action={{route("reserva.store")}} method="post">
            @csrf

           @if($user_perfil !== "Usuario")
            <div class="form-group">
                <label for="dni">DNI del usuario</label>
                <input class="form-control" id="dni" type="number" name="dni">
            </div>
            @endif
            <!-- Selección de la cancha -->
            <div class="form-group">
                <label for="cancha">Cancha Elegida:</label>
                <select class="form-control" id="cancha" name="id_cancha" required>
                    <option value="">Seleccionar Cancha</option>
                    @foreach($canchas as $cancha)
                        <option value="{{ $cancha->id_cancha }}">{{$cancha->tipocancha->Material}}, {{ $cancha->Cancha_cantidad_max_personas }} personas, Precio: ${{ $cancha->Cancha_precio_hora }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Selección de la fecha -->
            <div class="form-group">
                <label for="fecha">Fecha de Reserva:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <!-- Checkboxes de las horas disponibles -->
            <div class="form-group">
                <label for="horas">Horas Disponibles:</label>
                <div id="horas-container" class="form-check">
                    <!-- Aquí se mostrarán las horas disponibles después de la solicitud AJAX -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
    </div>

@endsection

@section('custom-scripts')
<script src={{asset('js/obtenerHorasDisponibles.js')}}></script>
@endsection
