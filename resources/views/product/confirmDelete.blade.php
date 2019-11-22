@extends ('layouts.base')
@section('title') EDIT PRODUCT @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Edit Product</h1>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
        <a class="btn btn-secondary" href="/products">back</a>
        <br>
        <br>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
        <h1>ARE YOU SURE?</h1>
        <br>
        <form action="/product/{{ $product->id }}" method="POST">
            @csrf 
            @method('delete')
            <button type="submit" class="btn btn-danger">DELETE</button>
        </form>
        </div>
    </div>
@endsection