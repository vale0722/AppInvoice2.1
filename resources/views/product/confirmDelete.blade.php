@extends ('layouts.app')
@section('title') DELETE PRODUCT @endsection
@section('content')

<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary" href="/products">back</a>
                <br>
                <br>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                ARE YOU SURE?
            </div>
            <div class="row text-center">
                <div class="col">
                    <br>
                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </div>
            </div>
            
            <br>
        </div>
    </div>
</div>
@endsection