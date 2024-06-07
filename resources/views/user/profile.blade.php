@extends('layout.mainlayout')
@section('content')
<div class=container>
	<h1>Hola</h1>
	<p>Nombre: {{ $persona->Nombre }}</p>
	<p>Apellido: {{ $persona->Apellido }}</p>
	<p>Tipo DNI: {{ $tipodni }}</p>
	<p>DNI: {{ $dni }}</p>
	
	<p>Correo: {{ $user->email }}</p>
	<p>Telefono: {{ $telefono }}</p>
	<p>Domicilio: {{ $domicilio }}
</div>
@endsection
