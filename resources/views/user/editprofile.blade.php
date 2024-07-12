@extends('layout.mainlayout')
@section('content')
<div class="container">
    <h1>Editar Perfil</h1>
    <form action="/profile/actualizar" method="post">
        @csrf

        @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $persona->Nombre }}" required>
        </div>
        
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $persona->Apellido }}" required>
        </div>

        <div class="form-group">
            <label for=fechanac>Fecha Nacimiento</label>
            <input 
                type="date"
                id="fechanac"
                name="fechanac"
                value="{{ date_format($persona->FechaNacimiento, "Y-m-d") }}" 
                required
                >
        </div>

        <div class="form-group">
            <label for="tipodni">Tipo DNI:</label>
            <select class="form-select" id="tipodni" name="tipodni" required>
                @foreach($tiposdni as $tipo)
                    <option 
                        value="{{ $tipo->id_TipoDocumento }}" 
                        {{ $tipo->TipoDocumento_desc == $tipodni ? 'selected' : '' }}
                    >
                    {{ $tipo->TipoDocumento_desc }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="number" class="form-control" id="dni" name="dni" value="{{ $dni }}" required>
        </div>

        {{-- <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div> --}}

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="number" class="form-control" id="telefono" name="telefono" value="{{ $telefono }}" required>
        </div>

        <div class="form-group">
            <label for="domicilio">Domicilio:</label>
            <input type="text" class="form-control" id="domicilio" name="domicilio" value="{{ $domicilio }}" required>
        </div>

        <div class="form-group">
            <label for="tipodni">Tipo Domicilio:</label>
            <select class="form-select" id="tipodomicilio" name="tipodomicilio" required>
                @foreach($tiposdomicilio as $tipo)
                    <option 
                        value="{{ $tipo->idTipoDomicilio }}" 
                        {{ $tipo->TipoDomicilio_desc == $tipodomicilio ? 'selected' : '' }}
                    >
                    {{ $tipo->TipoDomicilio_desc }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
        <a href="/profile" class="btn btn-danger">Cancelar</a>
</div>

@endsection
