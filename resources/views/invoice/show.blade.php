@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now= $now->format('Y-m-d H:i:s');
?>
<div class="container">
    <br>
    <div class="card">
        <div class="col">
            <br>
            <div class="col-xs-6">
                <h1><b> {{ $invoice->company->name }} </b></h1>
                <h3><small><b>NIT: </b> {{ $invoice->company->nit }}</small></h3>
            </div>
            <div class="col-xs-6 text-right">
                <h2><b> FACTURA </b></h2>
                <h3><small>Factura {{ $invoice->code }}</small></h3>
                <h5> @if (isset($invoice->state))
                    <button type="button" class="btn btn-success btn-sm"> Pago </button>
                    @elseif($invoice->duedate <= $now)
                    <button type="button" class="btn btn-danger btn-sm"> Vencido </button>
                    @else
                    <button type="button" class="btn btn-warning btn-sm"> Sin pagar </button>
                    @endif
                </h5>
                <br>
            </div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"> <b> CLIENTE: </b> </div>
                <div class="card-body">
                    <h5><b>Nombre: </b>{{ $invoice->client->name .' '. $invoice->client->last_name }} </h5>
                    <h5><b>Celular:</b> {{ $invoice->client->cellphone }} </h5>
                    <h5><b>Correo Electrónico:</b> {{ $invoice->client->email }} </h5>
                    <h5><b>Ubicación:</b> {{ $invoice->client->address }} </h5>
                    <h5><b>{{ $invoice->client->country .'-'.  $invoice->client->city}}</b></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"> <b> DETALLE DE FACTURA: </b> </div>
                <div class="card-body">
                    <h5><b>Fecha de creación: </b>{{ $invoice->created_at }} </h5>
                    <h5><b>Fecha de expiración:</b> {{ $invoice->duedate }} </h5>
                    <h5><b>Subtotal: </b>{{ '$'. $invoice->subtotal }}</h5>
                    <h5><b>iva (16%): </b> {{'$'. $invoice->vat}} </h5>
                    <h5><b>Total: </b>{{ '$'.$invoice->total}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="card">
        <div class="card-header text-right">
            <a class="btn btn-primary" href="/invoices/{{ $invoice->id }}/invoice_product/create"><i class="fas fa-cart-plus"></i> Añadir una nueva compra</a></div>
        <div class="row">
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
                            <td>{{ '$'.$product->pivot->unit_value }}</td>
                            <td>{{ '$'.$product->pivot->total_value }}</td>
                        </tr>
                        @endforeach
                </table>
                <div class="row text-right">
                    <div class="col-sm-9 col-sm-offset-9">
                        <p> <b> Subtotal: </b></p>
                        <p> <b> IVA (16%): </b></p>
                        <p> <b>Total;</b></p>
                    </div>
                    <div class="col-sm-2 col-sm-offset-9">
                        <p> {{ '$'.$invoice->subtotal }}</p>
                        <p> {{'$'.$invoice->vat }}</p>
                        <p> {{'$'.$invoice->total }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection