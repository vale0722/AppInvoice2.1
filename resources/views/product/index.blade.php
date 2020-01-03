@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> PRODUCTOS</b></div>
            <div><a class="btn btn-primary btn-circle btn-lg" href="{{ route('products.create') }}"><i class="fas fa-plus"></i></a></div>
            <div class="justify-content-end">
                <form action="{{ route('products.index') }}" method="GET" class="form-inline justify-content-end">
                    @if (!isset($search))
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div>
                                <select name="type" class="form-control mr-sm-2" id="type">
                                    <option disabled selected>Buscar por:</option>
                                    <option value="code">Código</option>
                                    <option value="name">Nombre</option>
                                    <option value="price">Precio</option>
                                </select>
                            </div>
                            <input type="text" class="form-control input-group-prepend" name="search" placeholder="Ingresa tu búsqueda" required>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> </button>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('products.index') }}" class="btn btn-circle btn-danger"><i class="fas fa-undo"></i> </button></a>
                    @endif
                </form>
            </div>
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
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ '$'.$product->price }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}"><i class="far fa-edit"></i> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('products.confirm.delete', $product->id) }}"><i class="far fa-trash-alt"></i> Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection