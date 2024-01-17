@extends('admin.auth.BaseAuth')

@section('content')
    <div class="card-body">
        <p class="login-box-msg">Iniciar sesión</p>

        <form action="{{ route('start') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="username" name="username" type="username" class="form-control" placeholder="nombre de usuario">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('username')
                <div class="text-small text-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <div class="text-small text-danger">{{ $message }}</div>
            @enderror
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Recuerdame
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


        <p class="mb-1">
            <a href="">Olvidó la contraseña</a>
        </p>
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Registrate</a>
        </p>
    </div>
@endsection
