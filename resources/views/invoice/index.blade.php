@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="text-center"><i class="fas fa-users"></i><b> FACTURAS </b></div>
            <div>
                <a class="btn btn-primary btn-circle btn-lg" href="/invoices/create"><i class="fas fa-plus"></i></a>
                <a class="btn btn-success btn-circle btn-lg" href="{{ route('invoices.import.view') }}"><i class="fas fa-file-import"></i></a>
                <a class="btn btn-warning btn-circle btn-lg" href="{{ route('export') }}"><i class="fas fa-file-export"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table col-md-12 table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CÓDIGO</th>
                            <th scope="col">Creación</th>
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
                            <td>{{ $invoice->title }}</td>
                            <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                            <td> {{ $invoice->company->name }}</td>
                            <td>
                                @if(isset($invoice->state))
                                <button type="button" class="btn btn-success btn-sm"> Pago </button>
                                @elseif($invoice->duedate <= $now) <button type="button" class="btn btn-danger btn-sm"> Vencido </button>
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm"> Sin pagar </button>
                                    @endif
                            </td>
                            <td>{{ '$'. $invoice->total }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"><i class="far fa-edit"></i> Editar </a>
                                    <a class="btn btn-danger" href="/invoices/{{ $invoice->id }}/confirmDelete"><i class="far fa-trash-alt"></i> Eliminar</a>
                                    <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
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