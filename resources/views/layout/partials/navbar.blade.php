
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="/home">AlquilerCanchas</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="/profile">Mi perfil</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href={{route("reserva.index")}}>Mis reservas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href={{route("reserva.create")}}>Nueva reserva</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/canchas/">Canchas</a>
					</li>
					@if(Auth::user()->perfil->Perfil_descripcion !== "usuario")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" role=button data-bs-toggle="dropdown" href="!#"> Reportes</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/Proyecto/reporte/horas-mas-res.php">Horas mas reservadas</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href='/gestion/'>Gestión</a>
					</li>
					@endif
					<li class="nav-item ms-5">
						<a class="nav-link" href={{route("logout")}}>Cerrar sesión</a>
					</li>
					
				</ul>
<!--
				<div class="d-flex">
					<a class="nav-link align-self-right" href="/Proyecto/logout/logout.php">Cerrar sesión</a>
				</div>
-->
			</div>
		</div>
	</nav>

