@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Editar Horario de Cancha {{$horario->idHorarioCancha}}</h1>
        <form action="/gestion/horarios-cancha/{{$horario->idHorarioCancha}}/update" method="post">
            <!-- CSRF Token -->
            @csrf


            {{-- <div class="form-group">
                <label for="rela_cancha">ID Cancha:</label>
                <input type="text" class="form-control" id="rela_cancha" name="rela_cancha" value="{{ $horario->rela_cancha }}" required>
            </div> --}}

            <div class="form-group">
                <label for="hora_desde">Hora Desde:</label>
                <input type="number" class="form-control" id="hora_desde" name="hora_desde" min=1 max=23 value="{{ $horario->hora_desde }}" required>
            </div>

            <div class="form-group">
                <label for="hora_hasta">Hora Hasta:</label>
                <input type="number" class="form-control" id="hora_hasta" name="hora_hasta" min=1 max=23 value="{{ $horario->hora_hasta }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
@endsection
