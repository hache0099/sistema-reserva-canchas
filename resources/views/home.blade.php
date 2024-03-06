<!DOCTYPE HTML>
<html>
	<head>
		<title>home</title>
	</head>
	<body>
		<h1>Logeado correctamente!!!</h1>
		<h2>Bienvenido {{ Auth::user()->persona()->first()->Nombre }} {{ Auth::user()->persona()->first()->Apellido }}!!</h2>
	</body>
</html>
