@extends('layout.mainlayout')
@section('content')
<div class=container>
	<h1>Mi Perfil</h1>
	@if (session('status'))
		<div class="alert alert-success" role="alert">
			{{ session('status') }}
		</div>
	@endif
	<p>Correo: {{ $user->email }}</p>
	<p>Nombre: {{ $persona->Nombre }}</p>
	<p>Apellido: {{ $persona->Apellido }}</p>
	<p>Fecha Nacimiento: {{ date_format($persona->FechaNacimiento, "d-m-Y") }}</p>
	<p>Tipo DNI: {{ $tipodni }}</p>
	<p>DNI: {{ $dni }}</p>
	
	
	<p>Telefono: {{ $telefono }}</p>
	<p>Domicilio: {{ $domicilio }}</p>

	<a href='/profile/editar' role='button' class='btn btn-primary'>Editar Perfil</a>
	<a href='/changePassword' role='button' class='btn btn-primary'>Cambiar contraseña</a>
</div>
@endsection
