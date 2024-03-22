@extends('layout.loginlayout')
@section('content')
<div class='m-auto'>
    <h1>Registro</h1>
    <form method="POST" action="/validateRegister">
        @csrf
		<h2>Usuario</h2>
        
		<div class='form-floating'>
			<input class=form-control placeholder='name@example.com' type="email" id="email" name="email" required>
			<label class=form-label  for="email">Correo electrónico</label>
		</div>
		
		<div class='form-floating'>
			<input class=form-control placeholder='password' type="password" id="password" name="password" required>
			<label class=form-label for="password">Contraseña</label>
		</div>
		
		<div class='form-floating'>
			<input class=form-control placeholder='password' type="password" id="password_confirmation" name="password_confirmation" required>
			<label class=form-label for="password_confirmation">Confirmar contraseña</label>
        </div>
        <h2>Datos personales</h2>
        
        <div class='form-floating'>
			<input class=form-control placeholder='nombre' type="text" id="name" name="name" required>
			<label class=form-label for="name">Nombre</label>
        </div>
        
        <div class='form-floating'>
			<input class=form-control placeholder='apellido' type="text" id="apellido" name="apellido" required>
			<label class=form-label for="apellido">Apellido</label>
        </div>
        
        <div class='form-floating'>
			<input class=form-control placeholder='dni' type="number" id="dni" name="dni" required>
			<label form=form-label for="dni">DNI</label>
        </div>
        
        <div class='form-floating'>
			<input class=form-control placeholder='telefono' type="number" id="telefono" name="telefono" required>
			<label class=form-label for="telefono">Teléfono</label>
		</div>
		
        <button class='btn btn-primary' type="submit">Registrarse</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
