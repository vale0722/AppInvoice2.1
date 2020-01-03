@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> VENDEDORES </b></div>
            <a class="btn btn-primary btn-circle" href="{{ route('companies.create') }}"><i class="fas fa-plus"></i></a>
            <form action="{{ route('companies.index') }}" method="GET" class="form-inline justify-content-end">
                @if (!isset($search))
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div>
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option disabled selected>Buscar por:</option>
                                <option value="nit">Nit</option>
                                <option value="name">Nombre</option>
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
                <a href="{{ route('companies.index') }}" class="btn btn-circle btn-danger"><i class="fas fa-undo"></i> </button></a>
                @endif
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NIT</th>
                            <th scope="col">Nombre</th>
                            <th scope="col"> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->nit }}</td>
                            <td>{{ $company->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('companies.edit', $company->id) }}"><i class="far fa-edit"></i> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('companies.confirm.delete', $company->id) }}"><i class="far fa-trash-alt"></i> Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $companies->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection