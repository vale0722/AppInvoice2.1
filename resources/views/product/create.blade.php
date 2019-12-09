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
                                <h1 class="h4 text-gray-900 mb-4">Crea un nuevo producto!</h1>
                            </div>
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
                            </div>
                            <form action="{{ route('products.index') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nombre:</label>
                                        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Código:</label>
                                        <input type="text" value="{{ old('code') }}" class="form-control" id="code" name="code" placeholder="código">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Precio:</label>
                                    <input type="number" value="{{ old('price') }}" class="form-control" id="price" name="price" placeholder="0">
                                    <label><b>-- RECUERDA QUE ESTE PRECIO ES EL PRECIO SUGERIDO AL PÚBLICO!</b></label>
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
    </div>
</div>
@endsection
