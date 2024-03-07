@extends('layout.loginlayout')
@section('content')
<!--
<div class='d-flex align-items-center py-4 bg-body-tertiary'>
-->
	<div class='m-auto mw-25'>
		<h1 class='h3 mb-3'>Login</h1>
		@if ($errors->any())
			<div class='alert alert-danger'>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
		@endif
		<form method="POST" action="/validateLogin">
			@csrf
			<div class='form-floating'>
				<input class=form-control placeholder='nombre@ejemplo.com' type="email" id="email" name="email" required>
				<label class=form-label for="email">Correo electrónico</label>
			</div>
			<div class='form-floating'>
				<input class=form-control placeholder=password type="password" id="password" name="password" required>
				<label class=form-label for="password">Contraseña</label>
			</div>
			<button class="btn btn-primary w-100 py-3" type="submit">Iniciar sesión</button>
		</form>
	</div>
<!--
</div>
-->
@endsection
