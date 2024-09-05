@extends('layout.mainlayout')
@section('title', 'Listado de socios')
@section('content')
<div class=container>
    <h1>Socios</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Socio</th>
                <th>Nombres</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Miembro Desde</th>
            </tr>
        </thead>
        <tbody>
            @foreach($socios as $socio)
                <tr>
                    <td> {{$socio->socio->id_socio}} </td>
                    <td> {{$socio->persona->Nombre . " " . $socio->persona->Apellido}} </td>
                    <td> {{$socio->persona->personadocumento->PersonaDocumento_desc}} </td>
                    <td> {{$socio->email}} </td>
                    <td> {{$socio->socio->estadomembresia->EstadoMembresia_descripcion}}</td>
                    <td> {{$socio->socio->Socio_fecha_alta}} </td>

                </tr>
            @endforeach
    </table>
</div>

@endsection
