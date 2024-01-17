@extends('Menu')

@section('start')

    {{-- @if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if (session('error_message'))
<div class="alert alert-danger">
    {{ session('error_message') }}
    </div> --}}

    <section class="pedidos">
        <div class="container">
            <h2 class="text-center">Mis Pedidos</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Dirección de Entrega</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order['product']['name'] }}</td>
                                    <td>{{ $order['amount'] }}</td>
                                    <td>{{ $order['address'] }}</td>
                                    <td>{{ $order['price'] }}</td>
                                    <td>{{ $order['description'] }}</td>
                                    <td class="text-center">
                                        {{-- {{- action="">
                                            <a href="" class="btn btn-danger">
                                                <i class="fas fa-minus-circle nav-icon"></i>
                                            </a>
                                    > --}}
                                        <form action="{{ route('eliminar', $order['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-minus-circle nav-icon"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No has realizado pedidos aún.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>


@endsection
