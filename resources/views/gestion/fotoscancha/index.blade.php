@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
        <h1>Fotos de las Canchas</h1>
        @foreach ($canchas as $cancha)
            <div class="card mb-4">
        
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Cancha ID: {{ $cancha->id_cancha }}</h2>
                    <div>
                        <a href="/gestion/fotos-canchas/create/{{$cancha->id_cancha}}" class="btn btn-success">Añadir Foto</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($cancha->canchafoto as $foto)
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <img src="{{ asset( $foto->CanchaFoto_ruta) }}" class="card-img-top" alt="Foto de Cancha">
                                    <div class="card-body">
                                        <p class="card-text">Ruta: {{ $foto->CanchaFoto_ruta }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
