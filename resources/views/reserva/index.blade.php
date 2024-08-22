@extends('layout.mainlayout')
@section('content')
	<div class=container>
		<div class='col'>
		<h2>Mis reservas</h2>
		<ul>
			
			@if (count($reservas) > 0)
				<ul>
				@foreach($reservas as $reserva)
					<li>{{$reserva->rela_cancha}} - {{ $reserva->Reserva_fecha }} - {{$reserva->Reserva_hora}}:00
				@endforeach
				</ul>
			@else
				<h3>No hay reservas pendientes</h3>
				<a href={{route('reserva.create')}}>Nueva reserva</a>
			@endif
		</ul>
	</div>
@endsection
