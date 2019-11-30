@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> PRODUCTOS</b></div>
            <div><a class="btn btn-primary btn-circle btn-lg" href="{{ route('products.create') }}"><i class="fas fa-plus"></i></a></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio ($)</th>
                            <th scope="col">Acciones</th>
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
@endsection