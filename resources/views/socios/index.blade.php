@extends('layout.mainlayout')
@section('title', 'Membresías')
@section('content')

<div class="container my-4">
    <h1 class="text-center">Únete a Nuestras Membresías</h1>
    <p class="lead text-center">¡Disfruta de todos los beneficios exclusivos al ser miembro de nuestra comunidad deportiva!</p>

    <!-- Sección de Membresías -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header bg-primary text-white">
                    <h2>Precio Actual de la Membresía</h2>
                </div>
                <div class="card-body">
                    <h3 class="card-title">$ {{ $precioMembresiaActual }}</h3>
                    <p class="card-text">
                        Al unirte, obtienes acceso prioritario a las reservas, descuentos en nuestras canchas y mucho más.
                    </p>
                    <a href="{{ route('membresia.unirse') }}" class="btn btn-success btn-lg">¡Unirme Ahora!</a>
                </div>
                <!--div class="card-footer text-muted">
                    Vigente hasta $fechaVigencia
                </div-->
            </div>
        </div>
    </div>

    <!-- Beneficios de la Membresía -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="text-center">Beneficios Exclusivos de las Membresías</h3>
            <ul class="list-group list-group-flush">
                <!--li class="list-group-item">Acceso prioritario a la reserva de canchas.</li-->
                <li class="list-group-item">Descuentos exclusivos en tarifas de reserva.</li>
                <!--li class="list-group-item">Participación en torneos y eventos exclusivos para miembros.</li-->
                <li class="list-group-item">Acceso a contenido y clases online especializadas.</li>
                <li class="list-group-item">Descuentos en tiendas asociadas y mucho más.</li>
            </ul>
        </div>
    </div>
</div>

@endsection

@section('custom-scripts')
<script>
    // Aquí puedes agregar cualquier lógica adicional para la vista, si es necesario
</script>
@endsection

