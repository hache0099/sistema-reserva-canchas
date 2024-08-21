@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Lista de Perfiles</h1>
    <div class="accordion" id="accordionExample">
    @foreach($perfiles as $p)
        
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$p->idPerfil}}" aria-expanded="true" aria-controls="collapse{{$p->idPerfil}}">
                {{$p->Perfil_descripcion}}
                </button>
            </h2>
        <div id="collapse{{$p->idPerfil}}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Modulos:
                <ul>
                @foreach($p->perfilmodulo as $pm)
                    <li>{{$pm->modulo->Modulo_descripcion}}</li>
                @endforeach
                </ul>
            </div>
        </div>
        </div>

    @endforeach
    </div>
</div>
@endsection