@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> VENDEDORES </b></div>
            <div><a class="btn btn-primary btn-circle btn-lg" href="{{ route('companies.create') }}"><i class="fas fa-plus"></i></a></div>
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
                {{ $companies->render()}}
            </div>
        </div>
    </div>
</div>
@endsection