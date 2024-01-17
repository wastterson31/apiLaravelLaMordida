@extends('Menu')

@section('start')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro - La Mordida</title>
    </head>

    <body>
        <section class="form-container">
            <form method="POST" action="{{ route('save') }}">
                @csrf
                <h3>Registro</h3>
                <input type="text" name="name" required placeholder="Nombre completo" maxlength="255" class="box">
                @error('name')
                    <div class="text-small text-danger">{{ $message }}</div>
                @enderror

                <input type="text" name="address" required placeholder="Barrio" class="box">
                @error('address')
                    <div class="text-small text-danger">{{ $message }}</div>
                @enderror

                <input type="text" name="phone" required placeholder="Número de teléfono" class="box">
                @error('phone')
                    <div class="text-small text-danger">{{ $message }}</div>
                @enderror

                <input type="text" name="username" required placeholder="Nombre de usuario" class="box">
                @error('username')
                    <div class="text-small text-danger">{{ $message }}</div>
                @enderror

                <input type="password" name="password" required placeholder="Contraseña" maxlength="20" class="box">
                @error('password')
                    <div class="text-small text-danger">{{ $message }}</div>
                @enderror

                <input type="password" name="password_confirmation" required placeholder="Confirma tu contraseña"
                    maxlength="20" class="box">
                @error('password_confirmation')
                    <div class="text-small text-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn" name="submit">Registrarse</button>
                <p>¿Ya tienes una cuenta?</p>
                <a href="{{ route('login') }}" class="option-btn">Iniciar sesión</a>
            </form>
        </section>
    </body>

    </html>
@endsection
