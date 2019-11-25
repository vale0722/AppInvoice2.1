@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="col">
        <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i class="fas fa-undo"></i> atrás</a>
    </div>
</div>
<br>
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h3> <b> {{ $client->name .' '. $client->last_name }} </h3></b>
        </div>
        <div class="card-body">
            <h4><b>Datos del cliente: </b> </h4>
            <h5><b>Celular:</b> {{ $client->cellphone }} </h5>
            <h5><b>Correo Electrónico:</b> {{ $client->email }} </h5>
            <h5><b>Ubicación:</b> {{ $client->address }} </h5>
            <h5><b>{{ $client->country .'-'.  $client->city}}</b></h5>
        </div>
    </div>
</div>
<br>

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h4> <b> FACTURAS A SU NOMBRE </h4></b>
        </div>
        <div class="row">
            <div class="col col-md-12 table-responsive-sm">
            <table class="table">
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
                    <tbody>
                        @foreach($client->invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->code }}</td>

                            <td>{{ $invoice->created_at }}</td>
                            <td><a href="{{route('invoices.show', $invoice->id)}}">{{ $invoice->title }}</a></td>
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
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection