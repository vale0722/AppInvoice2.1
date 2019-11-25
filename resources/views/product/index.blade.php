@extends ('layouts.app')
@section('title') PRODUCT @endsection
@section('content')

<div class="container">
    <div class="row ">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('products.create') }}"><i class="fas fa-plus"></i> añadir un nuevo producto</a>
            <br>
            <br>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-center"> <i class="fas fa-puzzle-piece"></i><b> PRODUCTOS</b></div>
        <div class="col">
            <div class="row col-md-12">
                <div class="col table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio ($)</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($product as $product)
                        <tbody>
                            <tr>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ '$'.$product->price }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}"><i class="far fa-edit"></i> Editar </a>
                                        <a class="btn btn-danger" href="/products/{{ $product->id }}/confirmDelete"><i class="far fa-trash-alt"></i> Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection