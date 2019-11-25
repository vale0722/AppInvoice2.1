@extends ('layouts.app')
@section('title') INVOICES @endsection
@section('content')

<div class="container">
    <div class=" row justify-content-center">
        <div class="col ">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <a class="btn btn-primary" href="/invoices/create"><i class="fas fa-plus"></i> Crear una nueva factura</a>
            <a class="btn btn-primary" href="{{ route('clients.index') }}"><i class="fas fa-users"></i> Clientes</a>
            <a class="btn btn-primary" href="{{ route('products.index') }}"><i class="fas fa-puzzle-piece"></i> Productos</a>
            <a class="btn btn-primary" href="{{ route('companies.index') }}"><i class="far fa-building"></i> Compañias</a>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12">
            <div class="card">
                <div class="card-header text-center"><i class="far fa-file-alt"></i><b> Facturas</b></div>
                <div class="col">
                    <div class="row col-md-12">
                        <div class="col  table-responsive ">
                            <table class="table col-md-12 table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">CÓDIGO</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Vendedor</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                @foreach($invoice as $invoice)
                                <tbody>
                                    <tr>
                                        <td>{{ $invoice->code }}</td>
                                        
                                        <td>{{ $invoice->created_at }}</td>
                                        <td><a href="invoices/{{ $invoice->id }}">{{ $invoice->title }}</a></td>
                                        <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                                        <td> {{ $invoice->company->name }}</td>
                                        <td></td>
                                        <td>{{ '$'. $invoice->total }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"><i class="far fa-edit"></i> Editar </a>
                                                <a class="btn btn-danger" href="/invoices/{{ $invoice->id }}/confirmDelete"><i class="far fa-trash-alt"></i> Eliminar</a>
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
    </div>
</div>
@endsection