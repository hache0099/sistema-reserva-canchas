<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form method="POST" action="/validateRegister">
        @csrf
		<h2>Usuario</h2>
        

        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        
        <h2>Datos personales</h2>
        
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" required>
        
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" required>
        
        <label for="dni">DNI</label>
        <input type="number" id="dni" name="dni" required>
        
        <label for="telefono">Teléfono</label>
        <input type="number" id="telefono" name="telefono" required>

        <button type="submit">Registrarse</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
