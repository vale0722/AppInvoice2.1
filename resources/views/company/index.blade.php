@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('companies.create') }}"><i class="fas fa-plus"></i> añadir una nueva compañia</a>
            <a class="btn btn-primary" href="{{ route('invoices.index') }}"><i class="far fa-file-alt"></i> Facturas</a>
            <a class="btn btn-primary" href="{{ route('products.index') }}"><i class="fas fa-puzzle-piece"></i> Productos</a>
            <a class="btn btn-primary" href="{{ route('clients.index') }}"><i class="fas fa-users"></i> Clientes</a>
            <br>
            <br>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-center"><i class="far fa-building"></i><b> COMPAÑIAS</b></div>
        <div class="col">
            <div class="row col-md-12">
                <div class="col table-responsive ">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NIT</th>
                                <th scope="col">Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($companies as $company)
                        <tbody>
                            <tr>
                                <td>{{ $company->nit }}</td>
                                <td>{{ $company->name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning" href="{{ route('companies.edit', $company->id) }}"><i class="far fa-edit"></i> Editar </a>
                                        <a class="btn btn-danger" href="/companies/{{ $company->id }}/confirmDelete"><i class="far fa-trash-alt"></i> Eliminar</a>
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