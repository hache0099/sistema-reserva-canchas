@extends('layout.mainlayout')
@section('title', 'Crear nuevo usuario')
@section('content')
<div class='container p-5 bg-light text-dark'>
    <div class='p-3 border rounded-3' style='background-color: white;'>
        <h1>Crear Usuario</h1>
        @if ($errors->any())
			<div class='alert alert-danger'>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
		@endif
        <form method="POST" action="/gestion/usuarios/store">
            @csrf
            <h2>Usuario</h2>

            <select class='form-select' name='perfil' required>
                <option selected>Elija un perfil</option>
                @foreach($perfiles as $perfil)
                    <option value={{$perfil->idPerfil}} {{old('perfil') === $perfil->idPerfil ? 'selected' : ''}}>{{$perfil->Perfil_descripcion}}</option>
                @endforeach
            </select>
            
            <div class='form-floating'>
                <input class=form-control placeholder='name@example.com' type="email" id="email" name="email" value='{{ old('email') }}' required>
                <label class=form-label  for="email">Correo electrónico</label>
            </div>
            
            <!-- Opcional: Ocultar el campo de contraseña o hacerla generada automáticamente -->
            <!-- <div class='form-floating'>
                <input class=form-control placeholder='password' type="password" id="password" name="password" required>
                <label class=form-label for="password">Contraseña</label>
            </div>

            <div class='form-floating'>
                <input class=form-control placeholder='password' type="password" id="password_confirmation" name="password_confirmation" required>
                <label class=form-label for="password_confirmation">Confirmar contraseña</label>
            </div> -->
            
            <h2>Datos personales</h2>

            
             <select class='form-select' id='tipodni' name='tipodni'>
                <option selected>Tipo de Documento</option>
                @foreach($tiposDocumento as $doc)
                    <option value='{{$doc->id_TipoDocumento}}' {{old('tipodni') === $doc->id_TipoDocumento ? 'selected' : ''}}>{{$doc->TipoDocumento_desc}}</option>
                @endforeach
            </select>

            <div class='form-floating'>
                <input class=form-control placeholder='dni' type="number" id="dni" name="dni" value='{{ old('dni') }}' required>
                <label form=form-label for="dni">DNI</label>
            </div>

            
            <!-- Campos existentes -->
            <div class='form-floating'>
                <input class=form-control placeholder='nombre' type="text" id="name" name="name" value='{{ old('name') }}'>
                <label class=form-label for="name">Nombre</label>
            </div>
            
            <div class='form-floating'>
                <input class=form-control placeholder='apellido' type="text" id="apellido" name="apellido" value='{{ old('apellido') }}'>
                <label class=form-label for="apellido">Apellido</label>
            </div>

           

            <div class='form-floating'>
                <input class=form-control placeholder='telefono' type="number" id="telefono" name="telefono" value='{{ old('telefono') }}' required>
                <label class=form-label for="telefono">Teléfono</label>
            </div>
        
            
            <!-- Otros campos se mantienen igual -->

            <button class='btn btn-primary' type="submit">Crear</button>
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

