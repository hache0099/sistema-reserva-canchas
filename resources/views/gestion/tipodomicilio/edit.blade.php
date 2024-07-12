@extends('layout.mainlayout')
@section('content')
<div class="container my-4">
    <h1>Editar Tipo de Domicilio</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/gestion/tipos-domicilio/{{$tipoDomicilio->idTipoDomicilio}}/update" method="post">
        @csrf
        <div class="form-group">
            <label for="TipoDomicilio_desc">Descripción:</label>
            <input type="text" class="form-control" id="TipoDomicilio_desc" name="TipoDomicilio_desc" value="{{ $tipoDomicilio->TipoDomicilio_desc }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

@endsection