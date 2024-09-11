<!DOCTYPE html>
<html>
<head>
    <title>Cambio de Contraseña</title>
</head>
<body>
    <h1>Bienvenido {{ $nombre }}</h1>
    <p>Estimado/a {{ $nombre }},</p>
    <p>Haga click <a
        href="http://localhost:8000/verifyChangePassword?token={{$token}}&id={{$id_usuario}}">
        Aquí</a>
        para cambiar tu contraseña</p>

</body>
</html>
