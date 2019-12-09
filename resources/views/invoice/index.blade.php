@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now= $now->format('Y-m-d H:i:s');
?>
<div class="container">
    <div class=" row justify-content-center">
        <div class="col ">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <a class="btn btn-primary" href="/invoices/create"><i class="fas fa-plus"></i> Crear una nueva factura</a>
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
                            <table class="table col-md-12 table-hover table-striped">
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
                                        <td>{{ $invoice->title }}</td>
                                        <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                                        <td> {{ $invoice->company->name }}</td>
                                        <td>
                                            @if(isset($invoice->state))
                                            <button type="button" class="btn btn-success btn-sm"> Pago </button>
                                            @elseif($invoice->duedate <= $now)
                                            <button type="button" class="btn btn-danger btn-sm"> Vencido </button>
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