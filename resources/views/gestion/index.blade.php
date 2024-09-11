@extends('layout.mainlayout')

@section('content')
<div class="container">
    <h1 class="my-4">Gestión</h1>

    <!-- Iterar sobre los módulos para generar las cartas -->
    <div class="row">
        @foreach($modulos as $modulo)
            <div class="col-md-4 mb-4">
                <div class="card">
                 <a href="{{ rtrim($modulo->Modulo_ruta, '*') }}" class="card-block stretched-link">
                    <div class="card-body text-center">
                        <!-- Mostrar descripción del módulo -->
                        <h5 class="card-title">{{ $modulo->Modulo_descripcion }}</h5>
                        <!-- Enlace a la ruta del módulo -->
                       
                    </div>
                </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

