@extends('layout.loginlayout')
@section('title','Registrarse')
@section('content')
<div class='container d-flex justify-content-center align-items-center' style='padding-top: 15%;'>
    <div class='p-4 border rounded-3 bg-white' style='max-width: 450px; width: 100%;'>
        <h1 class="text-center mb-4">Registro</h1>
    <form method="POST" id="registroForm" action="/validateRegister">
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
            <option value="" selected>Tipo de Documento</option>
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

@section("custom-scripts")

<script>
$(document).ready(function() {
    // Función de validación del formulario
    function validateField(field) {
        let isValid = true;
        $(field).next('.error-message').remove(); // Eliminar mensajes de error previos

        // Validar campos de texto, email, contraseñas, números y fechas
        if ($(field).is('input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"]')) {
            if ($.trim($(field).val()) === '') {
                $(field).addClass('is-invalid').removeClass('is-valid');
                $(field).after('<span class="error-message text-danger">Este campo es obligatorio.</span>');
                isValid = false;
            } else if ($(field).is('#email')) {
                // Validación específica para el email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test($(field).val())) {
                    $(field).addClass('is-invalid').removeClass('is-valid');
                    $(field).after('<span class="error-message text-danger">Por favor, introduce un email válido.</span>');
                    isValid = false;
                } else {
                    $(field).addClass('is-valid').removeClass('is-invalid');
                }
            } else if ($(field).is('#password')) {
                // Validación específica para la contraseña
                if ($(field).val().length < 8) {
                    $(field).addClass('is-invalid').removeClass('is-valid');
                    $(field).after('<span class="error-message text-danger">La contraseña debe tener al menos 8 caracteres.</span>');
                    isValid = false;
                } else {
                    $(field).addClass('is-valid').removeClass('is-invalid');
                }
            } else if ($(field).is('#password_confirmation')) {
                // Validación específica para la contraseña
                if ($(field).val() !== $('#password')) {
                    $(field).addClass('is-invalid').removeClass('is-valid');
                    $(field).after('<span class="error-message text-danger">La contraseñas no coinciden.</span>');
                    isValid = false;
                } else {
                    $(field).addClass('is-valid').removeClass('is-invalid');
                }
            } else if ($(field).is('#telefono')) {
                // Validación específica para el teléfono
                const telefonoRegex = /^[0-9\s()+\-]*$/;
                if (!telefonoRegex.test($(field).val())) {
                    $(field).addClass('is-invalid').removeClass('is-valid');
                    $(field).after('<span class="error-message text-danger">El número de teléfono solo puede contener números, espacios, +, -, ().</span>');
                    isValid = false;
                } else {
                    $(field).addClass('is-valid').removeClass('is-invalid');
                }
            } else if ($(field).is('#fechanac')) {
                // Validación específica para la fecha de nacimiento
                const fechaNacimientoDate = new Date($(field).val());
                const fechaActual = new Date();
                const edadMinima = 16;
                if (fechaNacimientoDate >= new Date(fechaActual.getFullYear() - edadMinima, fechaActual.getMonth(), fechaActual.getDate())) {
                    $(field).addClass('is-invalid').removeClass('is-valid');
                    $(field).after('<span class="error-message text-danger">Debe tener al menos 16 años.</span>');
                    isValid = false;
                } else {
                    $(field).addClass('is-valid').removeClass('is-invalid');
                }
            } else {
                $(field).addClass('is-valid').removeClass('is-invalid');
            }
        }

        // Validar campos select
        if ($(field).is('select')) {
            if ($(field).val() === '' || $(field).val() === 'Seleccionar') {
                $(field).addClass('is-invalid').removeClass('is-valid');
                $(field).after('<span class="error-message text-danger">Por favor, seleccione una opción válida.</span>');
                isValid = false;
            } else {
                $(field).addClass('is-valid').removeClass('is-invalid');
            }
        }

        return isValid;
    }

    // Evento de validación al dejar un campo (blur)
    $('input, select').blur(function() {
        validateField(this);
    });

    // Validación del formulario completo en el envío
    $('#registroForm').submit(function(event) {
        event.preventDefault(); // Evitar el envío del formulario temporalmente
        let isValid = true;

        // Validar cada campo del formulario
        $('input, select').each(function() {
            if (!validateField(this)) {
                isValid = false;
            }
        });

        // Si el formulario es válido, envíalo
        if (isValid) {
            this.submit();
        }
    });
});
</script>


@endsection
