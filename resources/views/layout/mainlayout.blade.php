<!DOCTYPE html>
<html lang="en">
	<head>
		@include('layout.partials.head')
	</head>
	<body>
		@include('layout.partials.navbar', ["perfil" => App\Models\User::find(Auth::user()->perfil->Perfil_descripcion)])
<!--
		@include('layout.partials.header')
-->
		@yield('content')
		{{-- include('layout.partials.footer') --}}
		@include('layout.partials.footer-scripts')
		@yield('custom-scripts')
	</body>
</html>
