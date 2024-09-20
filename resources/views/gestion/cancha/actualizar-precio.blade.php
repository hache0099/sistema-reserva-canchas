@extends('layout.mainlayout')

@section('content')
<div class="container">
    <h1>Gestión de Precios de Canchas</h1>

    <!-- Formulario para ingresar el porcentaje de ajuste -->
    <form id="updatePricesForm" action="{{ route('canchas.updatePrices') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="porcentaje">Ajustar Precios Porcentaje (%)</label>
            <!-- Agrega el evento 'input' para actualizar los precios en tiempo real -->
            <input type="number" id="porcentaje" name="porcentaje" class="form-control" step="0.01" placeholder="Ingrese el porcentaje de ajuste" oninput="calculateNewPrices()">
        </div>
    </form>

    <!-- Tabla que muestra las canchas con su precio actual y el nuevo precio -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Cancha</th>
                <th>Precio Actual</th>
                <th>Nuevo Precio</th>
            </tr>
        </thead>
        <tbody id="canchaPrices">
            @foreach($canchas as $cancha)
                <tr>
                    <td>{{ $cancha->id_cancha }}</td>
                    <td>{{ $cancha->precioActual ? $cancha->precioActual->precio : 'No disponible' }}</td>
                    <td id="new-price-{{ $cancha->id_cancha }}">
                        {{ $cancha->precioActual ? $cancha->precioActual->precio : 'No disponible' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón para enviar el formulario y actualizar los precios en la base de datos -->
    <button type="submit" form="updatePricesForm" class="btn btn-success">Actualizar Precios</button>
</div>

<!-- Script para calcular los nuevos precios al cambiar el porcentaje -->
<script>
    function calculateNewPrices() {
        // Obtener el porcentaje ingresado por el usuario
        let percentage = parseFloat(document.getElementById('porcentaje').value);
        if (isNaN(percentage)) {
            percentage = 0; // Si no es un número válido, establece el porcentaje en 0
        }

        // Obtener todas las filas de la tabla de precios
        const rows = document.querySelectorAll('#canchaPrices tr');

        rows.forEach(row => {
            let currentPriceCell = row.cells[1]; // Celda del precio actual
            let newPriceCell = row.cells[2]; // Celda del nuevo precio

            let currentPrice = parseFloat(currentPriceCell.innerText); // Obtener el precio actual

            if (!isNaN(currentPrice)) { // Verificar que el precio actual es un número
                let newPrice = currentPrice + (currentPrice * (percentage / 100)); // Calcular el nuevo precio
                newPriceCell.innerText = newPrice.toFixed(2); // Actualizar la celda con el nuevo precio, con dos decimales
            }
        });
    }
</script>
@endsection
