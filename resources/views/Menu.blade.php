<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La mordida</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js') }}">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/style2.css') }}">

    <script src="{{ asset('java/admin_script.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>



</head>
<style>
    .footer a {
        text-decoration: none;
    }
</style>

<body>

    <header class="header">

        {{-- {{ session('user_name') }} --}}

        <section class="flex">
            <a href="{{ route('Home') }}" class="logo" style="text-decoration: none">
                <img src="{{ asset('logo.png') }}" alt="Logo de la tienda" style="width: 89px; height: auto;">

            </a>
            <nav class="navbar">
                <a href="{{ route('Products') }}" style="text-decoration: none">Productos</a>


                @if (session('user_name') !== null)
                    <a href="{{ route('UserPedido') }}" style="text-decoration: none">Pedidos</a>
                    <div class="icons">
                        <div id="user-btn" class="fas fa-user">
                            <!-- Agrega aquí otros enlaces para usuarios autenticados -->
                            <span style="text-decoration: none">{{ session('user_name') }}</span>
                            <!-- Agrega aquí otros enlaces para usuarios autenticados -->
                        </div>
                    </div>
                    <div class="flex-btn">
                        <a href="{{ route('logout') }}" style="text-decoration: none" class="option-btn">Cerrar
                            Sesión</a>
                    </div>
                @else
                    <a href="{{ route('Register') }}" style="text-decoration: none">Registrarse</a>
                    <a href="{{ route('Session') }}" style="text-decoration: none">Iniciar Sesión</a>
                @endif

            </nav>
        </section>
    </header>
    <!-- Directiva que establece una señal para ser remplazada -->
    @yield('start')
    <div class="card-footer">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Menú Principal Links</h3>
                <a href="index.php"><i class="fas fa-angle-right"></i> Inicio</a>
                <a href="{{ route('Nosotros') }}"><i class="fas fa-angle-right"></i> Nosotros</a>
                <a href="{{ route('Products') }}"><i class="fas fa-angle-right"></i> Productos</a>
                <a href="#"><i class="fas fa-angle-right"></i> Contacto</a>
            </div>

            <div class="box">
                <h3>Entra a los enlaces</h3>
                <a href="#"><i class="fas fa-angle-right"></i> Iniciar Sesión</a>
                <a href="#"><i class="fas fa-angle-right"></i> Registrarse</a>
                <a href="#"><i class="fas fa-angle-right"></i> Carrito</a>
                <a href="#"><i class="fas fa-angle-right"></i> Contáctanos</a>
            </div>

            <div class="box">
                <h3>Contactos Personales</h3>
                <a href="tel:3173293020"><i class="fas fa-phone"></i> +573173293020</a>
                <a href="tel:3173293020"><i class="fas fa-phone"></i> +573173293020</a>
                <a href="mailto:josewastterson@gmail.com"><i class="fas fa-envelope"></i> josewastterson@gmail.com</a>
                <a
                    href="https://www.google.com/maps/place/Sala+honda+Nari%C3%B1o/@2.0401045,-78.658201,17z/data=!4m15!1m8!3m7!1s0x8e2da744c75b289d:0x30ecafe758cc4ef6!2sFrancisco+Pizarro,+Nari%C3%B1o!3b1!8m2!3d2.0403017!4d-78.6582394!16s%2Fm%2F02qmt9l!3m5!1s0x8e2d0b275eaf43ad:0xc1c1c8e980bd6c3b!8m2!3d2.0414103!4d-78.657955!16s%2Fg%2F11f8kbx38h?entry=ttu"><i
                        class="fas fa-map-marker-alt"></i> Nariño, Salahonda - Prvenir</a>
            </div>

            <div class="box">
                <h3>Redes Sociales</h3>
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
        </section>

        <div class="m-5 d-flex justify-content-center align-items-center">
            <strong>
                Jose Wastterson Preciado Ulloa
                Michahel Diafara Viojo
                Copyright &copy; 2023
                <a href="http://www.udenar.edu.co" style="text-decoration: none">Universidad de Nariño</a>
                Todos los derechos reservados
            </strong>
        </div>
    </footer>
    <script src="{{ asset('java/script.js') }}"></script>
    <!-- Inicializa Swiper -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Asegúrate de incluir jQuery y los scripts de Bootstrap antes de este script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        var swiper = new Swiper(".category-slider", {
            slidesPerView: 3, // Muestra 3 categorías en todas las resoluciones
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        var swiper = new Swiper(".products-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>



</body>

</html>

</body>

</html>
