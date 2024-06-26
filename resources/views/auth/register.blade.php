@extends('layout.loginlayout')
@section('content')
<div class='container p-5 bg-light text-dark'>
<div class='p-3 border rounded-3' style='background-color: white; margin: 20%'>
    <h1>Registro</h1>
    <form method="POST" action="/validateRegister">
        @csrf
		<h2>Usuario</h2>
        
		<div class='form-floating'>
			<input class=form-control placeholder='name@example.com' type="email" id="email" name="email" value='{{ old('email') }}' required>
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
			<input class=form-control placeholder='nombre' type="text" id="name" name="name" value='{{ old('name') }}' required>
			<label class=form-label for="name">Nombre</label>
        </div>
        
        <div class='form-floating'>
			<input class=form-control placeholder='apellido' type="text" id="apellido" name="apellido" value='{{ old('apellido') }}'required>
			<label class=form-label for="apellido">Apellido</label>
        </div>

        <div class='form-floating'>
			<input class=form-control placeholder='domicilio' type="text" id="domicilio" name="domicilio" value='{{ old('domicilio') }}' required>
			<label class=form-label for="domicilio">Domicilio</label>
        </div>

        <select class='form-select' id='tipodni' name='tipodni'>
            <option selected>Tipo de Documento</option>
            @foreach($tiposDocumento as $doc)
                <option value='{{$doc->id_TipoDocumento}}'>{{$doc->TipoDocumento_desc}}</option>
            @endforeach
        </select>
        
        <div class='form-floating'>
			<input class=form-control placeholder='dni' type="number" id="dni" name="dni" value='{{ old('dni') }}' required>
			<label form=form-label for="dni">DNI</label>
        </div>
        
        <div class='form-floating'>
			<input class=form-control placeholder='telefono' type="number" id="telefono" name="telefono" value='{{ old('telefono') }}' required>
			<label class=form-label for="telefono">Teléfono</label>
		</div>

        <input type='date' id='fechanac' name='fechanac' value='{{ old('fechanac') }}' required>
        <label class=form-label for="fechanac">Fecha Nacimiento</label>
		
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
</div>
@endsection
