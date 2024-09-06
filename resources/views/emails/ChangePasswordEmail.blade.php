<!DOCTYPE html>
<html>
<head>
    <title>Cambio de Contraseña</title>
</head>
<body>
    <h1>Bienvenido {{ $user->persona->Nombre }}</h1>
    <p>Estimado/a {{ $user->persona->Nombre }},</p>
    <p>Haga click <a
        href=localhost:8000/verifyChangePassword?token={{$token}}&id={{$user->id_usuario}}>
        Aquí</a>
        para cambiar tu contrasesa</p>

</body>
</html>
