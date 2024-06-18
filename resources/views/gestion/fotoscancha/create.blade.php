@extends('layout.mainlayout')
@section('content')
    <div class="container my-4">
        <h1>Añadir Foto a la Cancha</h1>
        @if($errors->any())
            <div class='alert alert-danger'>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
        @endif
        <form action="/gestion/fotos-canchas/store/{{$id_cancha}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="CanchaFoto_ruta">Foto de la Cancha:</label>
                <input type="file" class="form-control" id="CanchaFoto_ruta" name="CanchaFoto_ruta" required>
            </div>

            <button type="submit" class="btn btn-primary">Subir Foto</button>
        </form>
    </div>
@endsection
