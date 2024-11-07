@extends('layout.loginlayout')
@section('title','ingrese su email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}
                    @endforeach
                </ul>
            @endif
            <div class="card">
                <div class="card-header">Cambiar contraseña</div>
                <div class="card-body">
                    <form action="/changePassword/verifyEmail" method=post>
                        @csrf
                        <div class="form-floating">
                            <input class="form-control @error('emailnotexist') is-invalid @enderror"
                                placeholder="name@example.com" type=email id=email name=email
                                value="{{old('email')}}"
                                required
                            >
                            <label for=email>Ingrese su correo electrónico</label>
                            @error('emailnotexist')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type=submit class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
