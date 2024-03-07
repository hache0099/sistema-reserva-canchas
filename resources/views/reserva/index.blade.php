@extends('layout.mainlayout')
@section('content')
	<div class=container>
		<div class='col'>
		<h2>Mis reservas</h2>
		<ul>
			
			@if (count($reservas) > 0)
				@foreach($reservas as $reserva)
					<li> {{ $reserva->Reserva_fecha }}
				@endforeach
			@else
				<h3>No hay reservas pendientes</h3>
				<a href='/reservas/nueva'>Nueva reserva</a>
			@endif
		</ul>
	</div>
@endsection
