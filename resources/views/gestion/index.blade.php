@extends('layout.mainlayout')
@section('content')
<div class="container">
    <h1 class="my-4">Gestión</h1>
    
    <div class="card my-3">
        <div class="card-header">
            Gestión Usuarios
        </div>
        <div class="card-body">
            <ul>
                <li><a href="/gestion/usuarios">Usuarios</a></li>
                <li><a href="/gestion/tipos-contacto">Tipos de Contacto</a></li>
                <li><a href="/gestion/tipos-documento">Tipos de Documento</a></li>
                <li><a href="/gestion/perfiles">Perfiles</a></li>
            </ul>
        </div>
    </div>
    
    <div class="card my-3">
        <div class="card-header">
            Gestión Canchas
        </div>
        <div class="card-body">
            <ul>
                <li><a href="/gestion/canchas">Canchas</a></li>
                <li><a href="/gestion/tipos-cancha">Tipos de Cancha</a></li>
                <li><a href="/gestion/fotos-canchas">Fotos de Canchas</a></li>
                <li><a href="/gestion/horarios-canchas">Horarios de las Canchas</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection

