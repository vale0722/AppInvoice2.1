@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
<div class="container">
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-3">
                <div class="card-header text-center">
                    <h3> <b> Datos del cliente </h3></b>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <h5><b>Nombre:</b> {{ $client->name .' '. $client->last_name }}</h5>
                                <div class="card-body p-0">
                                    <h5><b>Identificación: </b> {{ $client->id_type . ': ' . $client->id_card }}
                                        <h5><b>Celular:</b> {{ $client->cellphone }} </h5>
                                        <h5><b>Correo Electrónico:</b> {{ $client->email }} </h5>

                                        <div class="text-right">
                                            <h5><b>Ubicación:</b> {{ $client->address }} </h5>
                                            <h5><b>{{ $client->country .'-'.  $client->city}}</b></h5>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-1 my-3">
                <div class="card-header text-center">
                    <h3> <b> FACTURAS A SU NOMBRE </h3></b>
                </div>
                <div class="card-body p-0">
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
                                    <td>{{ $invoice->title }}</td>
                                    <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                                    <td> {{ $invoice->company->name }}</td>
                                    <td>
                                        @if ($invoice->state == 'APPROVED')
                                        <button type="button" class="btn btn-success btn-sm"> Pago </button>
                                        @elseif($invoice->duedate <= $now) <button type="button" class="btn btn-danger btn-sm"> Vencido </button>
                                            @elseif($invoice->state == 'PENDING') <button type="button" class="btn btn-primary btn-sm"> Pendiente </button>
                                            @else
                                            <button type="button" class="btn btn-warning btn-sm">Sin Pagar </button>
                                            @endif
                                    </td>
                                    <td>{{ '$'. number_format($invoice->total, 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"><i class="far fa-edit"></i> Editar </a>
                                            <a class="btn btn-danger" href="/invoices/{{ $invoice->id }}/confirmDelete"><i class="far fa-trash-alt"></i> Eliminar</a>
                                            <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection