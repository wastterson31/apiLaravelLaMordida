@extends('Menu')

@section('start')
    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger">
            {{ session('error_message') }}
        </div>
    @endif

    <div class="home-bg">
        <section class="home">
            <div class="swiper home-slider">
                <div class="swiper-wrapper">

                    @foreach ($offers as $offer)
                        <div class="swiper-slide slide">
                            <div class="image">
                                <img src="{{ 'public/' . $offer['image'] }}" alt="Nombre de la imagen">
                            </div>
                            <div class="content">
                                <span>{{ $offer['description'] }}</span>
                                {{-- <h4>{{ $offer['amount'] }}</h4> --}}
                                <h3>{{ $offer['name'] }}</h3>
                                <h3>Precio: {{ $offer['price'] }}</h3>
                                <input type="hidden" name="offer" id="offer" value="{{ $offer['id'] }}">
                                @if (session('api_token'))
                                    <a class="btn comprar-btn" href="#" data-offers="{{ $offer['id'] }}"
                                        data-precio-offer="{{ $offer['price'] }}">Comprar</a>
                                @else
                                    <a class="btn btn-secondary" href="{{ route('Session') }}">Comprar</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </div>

    <style>
        .category a {
            text-decoration: none;
        }
    </style>
    <section class="category">
        <h1 class="heading">Categorías de productos</h1>

        <div class="swiper category-slider">
            <div class="swiper-wrapper">
                @foreach ($categories as $category)
                    <a href="{{ route('categories', ['id' => $category['id']]) }}" class="swiper-slide slide">
                        <img src="{{ 'public/' . $category['image'] }}" alt="{{ $category['name'] }}">
                        <h3>{{ $category['name'] }}</h3>
                    </a>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <form id="tuFormularioId" action="" method="POST">
        <input type="hidden" name="product_id" id="product_id" value="">
    </form>



    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var comprarButtons = document.querySelectorAll('.comprar-btn');

            comprarButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita la redirección del enlace

                    var offerId = this.getAttribute('data-offers');
                    var offerPrice = this.getAttribute('data-precio-offer');
                    var offerName = this.closest('.content').querySelector('h3').textContent;


                    updateOfferInForm(offerId, offerPrice, offerName);
                    // Abre el modal al hacer clic en el botón "Comprar"
                    $('#comprarModal').modal('show');
                });
            });


            function updateOfferInForm(offerId, offerPrice, offerName) {
                // Actualiza el valor del campo product_id, price y name en el formulario
                document.getElementById('product_id').value = parseInt(offerId);
                document.getElementById('price').value = parseFloat(offerPrice);
                document.getElementById('name').value = offerName;
            }
            // Agrega un evento al botón de confirmar compra en el modal
            document.getElementById('confirmarCompraBtn').addEventListener('click', function() {
                // Envía el formulario después de confirmar la compra
                document.getElementById('tuFormularioId').submit();
            });

            var category = document.getElementById('category_id');
            category.addEventListener('change', function() {
                var selectOption = this.options[category.selectedIndex];
                window.location.href = "/Products/categories/" + selectOption.value;
            });
        });
    </script>
    <!-- Modal para la confirmación de compra -->
    <div class="modal fade" id="comprarModal" tabindex="-1" aria-labelledby="comprarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pedidoModalLabel">Información del Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pedidoForm" method="POST" action="{{ route('buy') }}">
                        @csrf
                        <input type="hidden" name="name" id="name" value="">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $offer['id'] }}">
                        <input type="hidden" name="price" id="price" value="{{ $offer['price'] }}">
                        <!-- Agregar el siguiente campo para el nombre -->
                        <input type="hidden" name="name" id="name" value="">

                        <input type="hidden" name="user_id" id="user_id" value="{{ session('user_id') }}">
                        <div class="form-group">
                            <label for="amount">Cantidad:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección de Entrega:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="confirmarPedido">Confirmar Pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
