@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> CLIENTES</b></div>
            <div><a class="btn btn-primary btn-circle btn-lg" href="{{ route('clients.create') }}"><i class="fas fa-plus"></i></a></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Típo y número de identificación</th>
                            <th scope="col"> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->name . ' ' . $client->last_name }}</td>
                            <td>{{ $client->id_type . ': ' . $client->id_card}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('clients.edit', $client->id) }}"><i class="far fa-edit"></i> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('clients.confirm.delete', $client->id) }}"><i class="far fa-trash-alt"></i> Eliminar</a>
                                    <a class="btn btn-success" href="{{ route('clients.show', $client->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->render() }}
            </div>
        </div>
    </div>
</div>
@endsection