
function buscarHorarios() {
    // Obtener los valores seleccionados
    var canchaId = $('#cancha').val();
    var fecha = $('#fecha').val();

    //console.log(canchaId);

    // Asegurarse de que ambos campos estén llenos antes de hacer la solicitud AJAX
    if (canchaId && fecha) {
        $.ajax({
            url: '/reserva/getHorasDisponibles',
            type: 'GET',
            data: {
                id_cancha: canchaId,
                fecha: fecha,
                // _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                // Limpiar el contenedor de horas
                $('#horas-container').empty();
                console.log(response);

                // Añadir checkboxes para cada hora disponible
                //if()
                response.forEach(function(hora) {
                    var checkbox = `
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="hora${hora}" name="hora" value="${hora}">
                            <label for="hora${hora}" class="form-check-label">${hora}:00 - ${hora+1}:00</label>
                        </div>
                    `;
                    $('#horas-container').append(checkbox);
                });
            },
            error: function() {
                alert('Ocurrió un error al obtener las horas disponibles.');
            }
        });
    }
}

$(document).ready(function() {
    // Escuchar cambios en el select de cancha y el campo de fecha
    $('#cancha, #fecha').on('change', buscarHorarios);
});