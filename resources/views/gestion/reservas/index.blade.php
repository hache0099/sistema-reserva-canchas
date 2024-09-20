@extends('layout.mainlayout')
@section('title','Gestion de reservas')
@section('content')
<div class="container my-4">
    <h1>Gestión de Reservas</h1>
    
    <!-- Formulario de búsqueda -->
    <form id="formBuscarReservas">
        <div class="row mb-3">
            <!-- Campo de selección de fecha -->
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="date" class="form-control datepicker" id="fechaReserva" name="fechaReserva" required>
                    <label for="fechaReserva">Seleccionar Fecha</label>
                </div>
            </div>

            <!-- Campo de selección de ver reservas pendientes o todas -->
            <div class="col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="verPendientes" name="verPendientes">
                    <label class="form-check-label" for="verPendientes">Ver solo reservas pendientes</label>
                </div>
            </div>

            <!-- Botón de búsqueda -->
            <div class="col-md-4">
                <button type="button" id="buscarReservas" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Tabla para mostrar resultados -->
    <div class="table-responsive">
        <table class="table table-bordered" id="tablaReservas">
            <thead>
                <tr>
                    <th>Código Reserva</th>
                    <th>DNI</th>
                    <th>Hora de la Reserva</th>
                    <th>Cancha Elegida</th>
                    <th>Estado del Pago</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los resultados de la búsqueda aparecerán aquí -->
            </tbody>
        </table>
    </div>
</div>

@endsection

@section("custom-scripts")
<!-- Script para manejar la búsqueda con AJAX -->
<script>
$(document).ready(function() {
    $('#buscarReservas').on('click', function() {
        const fechaReserva = $('#fechaReserva').val();
        const verPendientes = $('#verPendientes').is(':checked') ? 1 : 0;
        console.log("verPendientes: ", verPendientes);

        // Realizar la solicitud AJAX al servidor
        $.ajax({
            url: '{{ route("gestion.reservas.buscar") }}',  // Ruta a la que se hará la solicitud
            type: 'GET',
            data: {
                fecha: fechaReserva,
                pendientes: verPendientes
            },
            success: function(reservas) {
                // Limpiar la tabla de resultados anteriores
                $('#tablaReservas tbody').empty();

                // Iterar a través de las reservas devueltas y agregarlas a la tabla
                reservas.forEach(function(reserva) {
                    $('#tablaReservas tbody').append(`
                        <tr>
                            <td>${reserva.id_reserva}</td>
                            <td>${reserva.user.persona.personadocumento.PersonaDocumento_desc}</td>
                            <td>${reserva.Reserva_hora}</td>
                            <td>${reserva.cancha.id_cancha}</td>
                            <td>${reserva.estadopago.EstadoPago_desc}</td>
                        </tr>
                    `);
                });
            },
            error: function(xhr) {
                console.error('Error al obtener las reservas:', xhr);
                alert('Hubo un error al buscar las reservas.');
            }
        });
    });
});
</script>
@endsection

