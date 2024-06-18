@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Crear Nuevo Tipo de Cancha</h1>
        <form action="/gestion/tipos-cancha/store" method="post">

            @csrf

            <div class="form-group">
                <label for="Material">Material:</label>
                <input type="text" class="form-control" id="Material" name="Material" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Tipo de Cancha</button>
        </form>
    </div>
@endsection
