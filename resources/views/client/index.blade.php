@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> CLIENTES</b></div>
            <div>
                <div><a class="btn btn-primary btn-circle btn-lg" href="{{ route('clients.create') }}"><i class="fas fa-plus"></i></a></div>
                <div class="justify-content-end">
                    <form action="{{ route('clients.index') }}" method="GET" class="form-inline justify-content-end">
                        @if (empty($_GET))
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div>
                                    <select name="type" class="form-control mr-sm-2" id="type">
                                        <option disabled selected>Buscar por:</option>
                                        <option value="name">Nombre</option>
                                        <option value="id_card">Documento de Identidad</option>
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
                        <a href="{{ route('clients.index') }}" class="btn btn-circle btn-danger"><i class="fas fa-undo"></i> </button></a>
                        @endif
                    </form>
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