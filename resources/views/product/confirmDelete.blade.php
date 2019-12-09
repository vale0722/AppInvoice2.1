@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-circle btn-lg btn-secondary" href="{{ route('products.index') }}"><i class="fas fa-undo"></i></a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('¿Estás realmente seguro?') }}</h1>
                                <span class="text-gray-900 mb-4">si lo haces perderas todos los datos del producto, incluyendo las facturas en las que se incluye.</h1>
                            </div>
                            <div class="col text-center my-3">
                                <form action="/products/{{ $product->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> ELIMINAR</button>
                                </form>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection