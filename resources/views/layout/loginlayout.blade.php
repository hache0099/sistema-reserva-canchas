<!DOCTYPE html>
<html lang="en">
	<head>
		@include('layout.partials.head',['title' => 'Iniciar Sesión'])
	</head>
	<body class='d-flex align-items-center py-4 bg-body-tertiary' style='height: 100vh;'>

		@yield('content')

		@include('layout.partials.footer-scripts')
	</body>
</html>
