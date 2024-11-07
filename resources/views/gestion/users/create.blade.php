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
                    <option value={{$perfil->idPerfil}} {{old('perfil') == $perfil->idPerfil || request('perfilACrear') == $perfil->idPerfil ? 'selected' : ''}}>{{$perfil->Perfil_descripcion}}</option>
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
@section('custom-scripts')
<script>
$(document).ready(function () {
    // Función para mostrar mensajes de error
    function showError(element, message) {
        console.log("asdf")
        $(element).addClass('is-invalid');  // Añadir clase de error
        $(element).next('.error-message').remove();  // Eliminar cualquier mensaje de error anterior
        $(element).after('<span class="error-message text-danger">' + message + '</span>');  // Mostrar el nuevo mensaje de error
    }

    // Función para remover mensajes de error
    function removeError(element) {
        $(element).removeClass('is-invalid');
        $(element).next('.error-message').remove();
    }

    // Validación de DNI al perder foco
    $('#dni').blur(function () {
        var dni = $(this).val();
        if (dni) {
            // Realizar la petición AJAX para verificar si el DNI ya está registrado
            $.ajax({
                url: '/gestion/usuarios/obtenerUsuarioPorDNI',
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',  // Añadir el token CSRF
                    dni: dni
                },
                dataType:"json",
                success: function (data) {
                    if (data.resultado === true) {
                        showError('#dni', 'Este DNI ya está registrado.');
                    } else {
                        removeError('#dni');
                    }
                },
                error: function () {
                    showError('#dni', 'Error al verificar el DNI.');
                }
            });
        } else {
            showError('#dni', 'El campo DNI es obligatorio.');
        }
    });

    // Validación de Email al perder foco
    $('#email').blur(function () {
        var email = $(this).val();
        if (email) {
            // Realizar la petición AJAX para verificar si el Email ya está registrado
            $.ajax({
                url: '/gestion/usuarios/obtenerUsuarioPorEmail',
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',  // Añadir el token CSRF
                    email: email
                },
                dataType:"json",
                success: function (data) {
                    if (data.resultado === true) {
                        showError('#email', 'Este correo electrónico ya está registrado.');
                    } else {
                        removeError('#email');
                    }
                },
                error: function () {
                    showError('#email', 'Error al verificar el correo electrónico.');
                }
            });
        } else {
            showError('#email', 'El campo Correo electrónico es obligatorio.');
        }
    });

    // Validación general al desenfocar otros campos
    $('#name, #apellido, #telefono').blur(function () {
        var value = $(this).val();
        if (!value) {
            showError(this, 'Este campo es obligatorio.');
        } else {
            removeError(this);
        }
    });
});
</script>

@endsection
