@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> CLIENTES</b></div>
            <div>
                <div>
                    @can('clients.create')
                    <a class="btn btn-primary btn-circle btn-lg" href="{{ route('clients.create') }}"><i class="fas fa-plus"></i></a>
                    @endcan
                    @can('clients.import')
                    <a class="btn btn-success btn-circle btn-lg" href="{{ route('clients.import.view') }}"><i class="fas fa-file-import"></i></a>
                    @endcan
                    @can('clients.export')
                    <a class="btn btn-warning btn-circle btn-lg" href="{{ route('clients.export') }}"><i class="fas fa-file-export"></i></a>
                    @endcan
                </div>
            </div>
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
                            <td>{{ $client->user->name . ' ' . $client->user->lastname }}</td>
                            <td>{{ $client->id_type . ': ' . $client->id_card}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('update', $client)
                                    <a class="btn btn-warning" href="{{ route('clients.edit', $client->id) }}"><i class="far fa-edit"></i> Editar </a>
                                    @endcan
                                    @can('delete', $client)
                                    <a class="btn btn-danger" href="{{ route('clients.confirm.delete', $client->id) }}"><i class="far fa-trash-alt"></i> Eliminar</a>
                                    @endcan
                                    @can('clients.show')
                                    <a class="btn btn-success" href="{{ route('clients.show', $client->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection