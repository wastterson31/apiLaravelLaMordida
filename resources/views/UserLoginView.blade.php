@extends('Menu')

@section('start')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - La Mordida</title>
    </head>

    <body>
        <section class="form-container">
            <form method="POST" action="{{ route('start') }}">
                @csrf

                <h3>Inicia Sesión</h3>
                <input type="text" name="username" required placeholder="Usuario" maxlength="50" class="box">
                <input type="password" name="password" required placeholder="Contraseña" maxlength="20" class="box">
                <button type="submit" class="btn" name="submit">Iniciar Sesión</button>
                <p>¿No tienes una cuenta?</p>
                <a href="{{ route('Register') }}" class="option-btn">Crea tu cuenta</a>
            </form>
        </section>
    </body>

    </html>
@endsection
