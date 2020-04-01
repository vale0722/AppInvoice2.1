@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
<div class="container">
    @if($errors->any())
    <div id="divErrors">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <ul>
                <li>{{ $error }}</li>
            </ul>
        </div>
        <br>
        @endforeach
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-3">
                <div class="card-header">
                    <div class="col-xs-12 text-center">
                        <h2><b> FACTURA </b></h2>
                        <h3><small>Factura {{ $invoice->code }}</small></h3>
                        <h5>
                            @if($invoice->isApproved())
                            <span class="badge badge-success">Pago</span>
                            @elseif($invoice->duedate <= $now) <span class="badge badge-danger">Vencido</span>
                                @elseif($invoice->isPending())
                                <span class="badge badge-primary">Pendiente</span>
                                @else
                                <span class="badge badge-warning">Sin Pagar </span>
                                @endif
                                @if (isset($invoice->receipt_date))
                                <span class="badge badge-primary">Recibido</span>
                                @else
                                <span class="badge badge-secundary">Sin Recibir</span>
                                @endif
                        </h5>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="card o-hidden border-0 shadow my-3">
                        <div class="card-header"> <b> CLIENTE: </b> </div>
                        <div class="card-body p-4">
                            <h5><b>Nombre: </b>{{ $invoice->client->user->name .' '. $invoice->client->user->lastname }} </h5>
                            <h5><b>Celular:</b> {{ $invoice->client->cellphone }} </h5>
                            <h5><b>Correo Electrónico:</b> {{ $invoice->client->user->email }} </h5>
                            <h5><b>Ubicación:</b> {{ $invoice->client->address }} </h5>
                            <h5><b>{{ $invoice->client->country .'-'. $invoice->client->department .'-'.  $invoice->client->city}}</b></h5>
                            <h5><br></h5>
                            @if (isset($invoice->state))
                            <h5><br></h5>
                            @endif
                            @if (isset($invoice->receipt_date))
                            <h5><br></h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="card o-hidden border-0 shadow my-3">
                        <div class="card-header"> <b> DETALLE DE FACTURA: </b> </div>
                        <div class="card-body p-4">
                            <h5><b>Vendedor: </b>{{ $invoice->creator->name .' '. $invoice->creator->lastname }} </h5>
                            <h5><b>Fecha de creación: </b>{{ $invoice->created_at }} </h5>
                            <h5><b>Fecha de expiración:</b> {{ $invoice->duedate }} </h5>
                            @if ($invoice->isApproved())
                            <h5><b>Fecha de pago:</b> {{ $invoice->payment_date}} </h5>
                            @endif
                            @if (isset($invoice->receipt_date))
                            <h5><b>Fecha de recibo:</b> {{ $invoice->receipt_date}} </h5>
                            @endif
                            <h5><b>Subtotal: </b>{{ '$'. number_format($invoice->subtotal, 2)  }}</h5>
                            <h5><b>iva (16%): </b> {{'$'. number_format($invoice->vat) }} </h5>
                            <h5><b>Total: </b>{{ '$'. number_format($invoice->total) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-1 my-3">
                <div class="card-body p-0">
                    <div class="col col-md-12 table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->products as $product)
                                <tr>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ '$'. number_format($product->pivot->unit_value) }}</td>
                                    <td>{{ '$'. number_format($product->pivot->total_value) }}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row text-right">
                            <div class="col-sm-9 col-sm-offset-9">
                                <p> <b> Subtotal: </b></p>
                                <p> <b> IVA (16%): </b></p>
                                <p> <b>Total:</b></p>
                            </div>
                            <div class="col-sm-2 col-sm-offset-9">
                                <p> {{ '$'. number_format($invoice->subtotal) }}</p>
                                <p> {{'$'. number_format($invoice->vat) }}</p>
                                <p> {{'$'. number_format($invoice->total) }}</p>
                            </div>
                        </div>
                    </div>
                    @can('paymentView', $invoice)
                    <a class="btn btn-primary btn-block" href="{{ route('payments.index', $invoice->id) }}"><i class="far fa-eye"></i> Ver intentos de pago </a>
                    @endcan
                    @can('invoices.pay')
                    @if(!$invoice->isApproved())
                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#create">
                        Realiza el pago de la factura
                    </a>
                    @endif
                    @endcan
                </div>
            </div>
            @include('invoice.payment.create')
        </div>
    </div>
</div>
@endsection