@extends ('layouts.app')
@section('title') NEW PRODUCT @endsection
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
                <div class="card-header text-center"> <b>NEW PRODUCT</b></div>
                <br>
                <div class="col">
                    <form action="/products" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name:</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="code">Code:</label>
                                <input type="text" value="{{ old('code') }}" class="form-control" id="code" name="code" placeholder="code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" value="{{ old('price') }}" class="form-control" id="price" name="price" placeholder="0">
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