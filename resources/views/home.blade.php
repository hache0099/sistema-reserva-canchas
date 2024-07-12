@extends('layout.mainlayout')
@section('content')
		<h1>Logeado correctamente!!!</h1>
		<h2>Bienvenido {{ Auth::user()->persona->Nombre }} {{ Auth::user()->persona->Apellido }}!!</h2>
		
		<a href='/profile'>Ir a mi perfil</a><br>
		<a href='/logout'>Cerrar sesión</a>
@endsection
