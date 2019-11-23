@extends ('layouts.app')
@section('title') EDIT PRODUCT @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/products">back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <br>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header text-center"> <b>EDIT PRODUCT</b></div>
                <br>
                <div class="col">
                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label> Name: </label>
                                <input type="text" value="{{ $product->name }}" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="code">Code:</label>
                                <input type="text" value="{{ $product->code }}" class="form-control" id="code" name="code" placeholder="code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" value="{{ $product->price }}" class="form-control" id="price" name="price" placeholder="0">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection