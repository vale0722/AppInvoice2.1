@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="{{ route('products.index') }}"><i class="fas fa-undo"></i> atrás</a>
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
                <div class="card-header text-center"> <b>EDITAR PRODUCTO</b></div>
                <br>
                <div class="col">
                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label> Nombre: </label>
                                <input type="text" value="{{ $product->name }}" class="form-control" id="name" name="name" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="code">Código:</label>
                                <input type="text" value="{{ $product->code }}" class="form-control" id="code" name="code" placeholder="código">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio:</label>
                            <input type="number" value="{{ $product->price }}" class="form-control" id="price" name="price" placeholder="0">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                        </div>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection