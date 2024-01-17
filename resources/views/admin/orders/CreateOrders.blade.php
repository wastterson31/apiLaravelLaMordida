@extends('admin.BaseAdmin')

@section('title')
    <div style="

    position: relative;
    left: 360px;">
        Modificar una orden</div>
@endsection

@section('content')
    <div class="row">
        <div class="offset-3 col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('order.index') }}" method="POST">
                        @include('admin.orders.FormOrder')

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit"> Registrar </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
