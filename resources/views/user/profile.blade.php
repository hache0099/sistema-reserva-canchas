@extends('layout.mainlayout')
@section('content')
<div class=container>
	<h1>Hola</h1>
	<p>DNI: {{ $dni }}</p>
	<p>Nombre: {{ $persona->Nombre }}</p>
	<p>Apellido: {{ $persona->Apellido }}</p>
	<p>Correo: {{ $user->email }}</p>
	<p>Telefono: {{ $telefono->PersonaContacto_desc }}</p>
	<p>Domicilio: {{ $domicilio }}
</div>
@endsection
