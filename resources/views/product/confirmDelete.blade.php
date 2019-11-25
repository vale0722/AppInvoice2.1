@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary" href="{{ route('products.index') }}"><i class="fas fa-undo"></i> atrás</a>
                <br>
                <br>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                ¿Estás realmente seguro?
            </div>
            <div class="row text-center">
                <div class="col">
                    <br>
                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>ELIMINAR</button>
                    </form>
                </div>
            </div>

            <br>
        </div>
    </div>
</div>
@endsection