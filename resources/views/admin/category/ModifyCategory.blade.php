@extends('admin.BaseAdmin')

@section('title')
    <div style="

    position: relative;
    left: 360px;">
        Modificar una categoría</div>
@endsection

@section('content')
    <div class="row">
        <div class="offset-3 col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.update', $category['id']) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.category.FormCategory')

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit"> Modificar </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
