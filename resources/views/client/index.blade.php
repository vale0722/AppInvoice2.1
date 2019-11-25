@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('clients.create') }}"><i class="fas fa-plus"></i> añadir un nuevo cliente</a>
            <a class="btn btn-primary" href="{{ route('invoices.index') }}"><i class="far fa-file-alt"></i> Facturas</a>
            <a class="btn btn-primary" href="{{ route('products.index') }}"><i class="fas fa-puzzle-piece"></i> Productos</a>
            <a class="btn btn-primary" href="{{ route('companies.index') }}"><i class="far fa-building"></i> Compañias</a>
            <br>
            <br>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header text-center"><i class="fas fa-users"></i><b> CLIENTES</b></div>
        <div class="col">
            <div class="row col-md-12">
                <div class="col">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Tipo de Documento</th>
                                <th scope="col">Número de Documento</th>
                                <th scope="col">Correo Electrónico</th>
                                <th scope="col">Celular</th>
                                <th scope="col">País</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Dirección</th>
                                <th scope="col"> Acciones</th>
                            </tr>
                        </thead>
                        @foreach($client as $client)
                        <tbody>
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->last_name }}</td>
                                <td>{{ $client->id_type }}</td>
                                <td>{{ $client->id_card }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->cellphone }}</td>
                                <td>{{ $client->country }}</td>
                                <td>{{ $client->city }}</td>
                                <td>{{ $client->address }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-warning" href="{{ route('clients.edit', $client->id) }}"><i class="far fa-edit"></i> Editar </a>
                                        <a class="btn btn-danger" href="/clients/{{ $client->id }}/confirmDelete"><i class="far fa-trash-alt"></i> Eliminar</a>
                                        <a class="btn btn-success" href="{{ route('clients.show', $client->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
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