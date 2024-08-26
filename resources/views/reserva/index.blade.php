@extends('layout.mainlayout')
@section('content')
	<div class=container>
		<div class='col'>
		<h2>Mis reservas</h2>
		<ul>
			
			@if (count($reservas) > 0)
				<ul>
				@foreach($reservas as $reserva)
				<div class="row mt-3">
					<div class="container p-3 border rounded-3">
						<div class="d-flex w-100 justify-content-between">
							<h4>Reserva Cod: {{$reserva->id_reserva}}</h4>
							<h5>Fecha: {{$reserva->Reserva_fecha}}</h5>
						</div>
						<div class="my-3">
							<h5>Canchas y Horas</h5>
							Cancha: Cancha {{$reserva->cancha->id_cancha}}: {{$reserva->cancha->tipocancha->Material}}
							Hora: {{$reserva->Reserva_hora}}:00
							Estado: {{$reserva->reservaestado->ReservaEstado_descripcion}}
						</div>
						<div class="mt-3">
							<a role="button" class="btn btn-primary" href={{route("reserva.edit",['reserva' => $reserva])}}>Editar</a>
						</div>
					</div>
				</div>	
				@endforeach
				</ul>
			@else
				<h3>No hay reservas pendientes</h3>
				<a href={{route('reserva.create')}}>Nueva reserva</a>
			@endif
		</ul>
	</div>
@endsection
