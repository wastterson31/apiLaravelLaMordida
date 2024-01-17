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

    <section class="products">
        <h2>Productos</h2>
        <!-- Botón de desplegable -->
        <div class="col-12 d-flex justify-content-center">
            <div class="mb-3">
                <label for="category_id" class="form-label">Selecciona una categoría</label>
                <select class="form-select form-select-lg" name="category_id" id="category_id">
                    <option value="0" selected>Todas</option>
                    @isset($categories)
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}"
                                @isset($category_id)
                                    @selected($category_id == $category['id'])
                                @endisset>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="all-products">
            @isset($products)
                @foreach ($products as $producto)
                    <div class="product">
                        {{-- @if (isset($producto['image'])) --}}
                        <img src="{{ asset('public/' . $producto['image']) }}"
                            alt="{{ $producto['name'] ?? 'Nombre no disponible' }}">
                        {{-- @else --}}
                        {{-- <img src="{{ asset('public/default-image.jpg') }}"
                                alt="{{ $producto['name'] ?? 'Nombre no disponible' }}"> --}}
                        {{-- @endif --}}
                        {{-- <div class="product-info">
                            <h4 class="product-title">{{ $producto['name'] ?? 'Nombre no disponible' }}</h4>
                            <p class="product-price">Precio: {{ $producto['price'] ?? 'Precio no disponible' }}</p>
                            <input type="hidden" name="producto" id="producto"
                                value="{{ $producto['id'] ?? 'Precio no disponible' }}">
                            @if (session('api_token'))
                                <a class="product-btn" href="#"
                                    data-product="{{ $producto['id'] ?? 'Precio no disponible' }}">Comprar</a>
                            @else
                                <a class="btn btn-secondary" href="{{ route('Session') }}">Comprar</a>
                            @endif
                        </div> --}}

                        <div class="product-info">
                            <h4 class="product-title">{{ $producto['name'] }}</h4>
                            <p class="product-price">Precio: {{ $producto['price'] }}</p>
                            <input type="hidden" name="producto" id="producto" value="{{ $producto['id'] }}">
                            @if (session('api_token'))
                                <a class="product-btn" href="#" data-product="{{ $producto['id'] }}">Comprar</a>
                            @else
                                <a class="btn btn-secondary" href="{{ route('Session') }}">Comprar</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Manejar el caso en que no hay productos --}}
                <p>No hay productos disponibles.</p>
            @endisset
        </div>
    </section>


    <form id="tuFormularioId" action="tu_ruta_de_envio" method="POST">
        <!-- Otros campos del formulario -->
        <input type="hidden" name="product_id" id="product_id" value="">
        <!-- Otros campos del formulario -->
    </form>


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var comprarButtons = document.querySelectorAll('.product-btn');

            comprarButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita la redirección del enlace

                    var productId = this.getAttribute('data-product');
                    updateProductInForm(productId);

                    // Abre el modal al hacer clic en el botón "Comprar"
                    $('#comprarModal').modal('show');
                });
            });

            function updateProductInForm(productId) {
                // Actualiza el valor del campo product_id en el formulario
                document.getElementById('product_id').value = productId;
            }

            // Agrega un evento al botón de confirmar compra en el modal
            document.getElementById('confirmarCompraBtn').addEventListener('click', function() {
                // Aquí puedes realizar alguna acción adicional antes de enviar el formulario
                // ...

                // Envía el formulario después de confirmar la compra
                document.getElementById('tuFormularioId').submit();
            });
        });

        var category = document.getElementById('category_id');
        category.addEventListener('change', function() {
            var selectOption = this.options[category.selectedIndex];
            window.location.href = "/Products/categories/" + selectOption.value;
        });
    </script>

@endsection

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
                    <input type="hidden" name="product_id" id="product_id"
                        value="{{ $producto['id'] ?? 'Precio no disponible' }}">
                    <input type="hidden" name="price" id="price"
                        value="{{ $producto['price'] ?? 'Precio no disponible' }}">

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
