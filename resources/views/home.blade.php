<!DOCTYPE HTML>
<html>
	<head>
		<title>home</title>
	</head>
	<body>
		<h1>Logeado correctamente!!!</h1>
		<h2>Bienvenido {{ Auth::user()->persona->Nombre }} {{ Auth::user()->persona->Apellido }}!!</h2>
		
		<a href='/reservas'>Ir a mis reservas</a>
		<a href='/logout'>Cerrar sesión</a>
	</body>
</html>
