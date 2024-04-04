@extends('layout.mainlayout')
@section('content')
<div class=container>
	<h1>Hola</h1>
	<p>DNI: {{ $persona->DNI }}</p>
	<p>Nombre: {{ $persona->Nombre }}</p>
	<p>Apellido: {{ $persona->Apellido }}</p>
	<p>Correo: {{ $user->email }}</p>
	<p>Telefono: {{ $persona->Telefono }}</p>
</div>
@endsection
