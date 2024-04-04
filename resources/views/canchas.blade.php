@extends('layout.mainlayout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Canchas disponibles</h1>
            <div class="row">
                @if (count($canchas) > 0)
                @foreach ($canchas as $cancha)
                    <div class=col>
                        <div class=card>
                            <img 
                                src={{asset(
                                    'img/canchas/cancha_'. $cancha->id_cancha . '.jpg')}}
                                class='card-img-top img-thumbnail object-fit-contain'>
                            <div class=card-body>
                                <h5 class=card-title>Cancha {{ $cancha->id_cancha }}</h5>
                            </div>
                            <ul class='list-group list-group-flush'>
                                <li class=list-group-item>Suelo: {{$cancha->tipocancha->Material}}</li>
                                <li class=list-group-item>
                                    Hasta {{$cancha->Cancha_cantidad_max_personas}} personas
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                @else
                    <h3>no hay canchas</h3>
                @endif
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-1">
        <div class="col-md-10 text-center">
            <small>*Las imágenes son solo ilustrativas</small>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-10 text-center">
            <a href='/Proyecto/reserva/nueva_reserva.php' class="btn btn-primary">
                Hacer una reserva
            </a>
        </div>
    </div>
    <!---/div---->

@endsection
