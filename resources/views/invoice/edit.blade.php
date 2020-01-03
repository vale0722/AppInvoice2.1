@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-circle btn-lg btn-secondary" href="{{ route('invoices.index') }}"><i class="fas fa-undo"></i></a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Edita la factura') }}:</h1>
                            </div>
                            <div class="col">
                                <br>
                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <form action="/invoices/{{ $invoice->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Título: </label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $invoice->title }}" placeholder="título">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Código: </label>
                                        <input type="text" class="form-control" id="code" name="code" value="{{ $invoice->code }}" placeholder="código">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Vendedor: </label>
                                        <select name="company_id" id="company_id" class="form-control @error('company') is-invalid @enderror">
                                            <option value='{{ $invoice->company->id }}' selected>{{$invoice->company->nit . ': ' . $invoice->company->name }}</option>
                                            @foreach($companies as $company)
                                            <option value=' {{ $company->id }}'> {{ $company->nit . ': ' . $company->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cliente: </label>
                                        <select name="client_id" id="client_id" class="form-control @error('client') is-invalid @enderror">
                                            <option value='{{ $invoice->client->id }}' selected>{{$invoice->client->id_type . ' ' . $invoice->client->id_card . ': ' . $invoice->client->name . ' ' . $invoice->client->last_name }}</option>
                                            @foreach($clients as $client)
                                            <option value='{{ $client->id }}'> {{ $client->id_type . ' ' . $client->id_card . ': ' . $client->name . ' ' . $client->last_name  }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Estado: </label>
                                    <select name="state" id="state">
                                        @if (isset($invoice->state))
                                        <option value='1' selected>PAGADA</option>
                                        <option value='2'> Sin pagar </option>
                                        @else
                                        <option value='2' selected> SIN PAGAR </option>
                                        <option value='1'> Pagada </option>
                                        @endif
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" id="subtotal" name="subtotal" value="{{ $invoice->subtotal }}">
                                <input type="hidden" class="form-control" id="total" name="total" value="{{ $invoice->total }}">
                                <input type="hidden" class="form-control" id="vat" name="vat" value="{{ $invoice->vat }}">

                                <br>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                                </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-9">
                                <div class="card o-hidden border-1 my-3">
                                    <div class="card-header text-right">
                                        <a class="btn btn-primary" href="/invoices/{{ $invoice->id }}/invoice_product/create"><i class="fas fa-cart-plus"></i> Añadir una nueva compra</a>
                                    </div>
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
                                                        <td>{{ '$'.$product->pivot->unit_value }}</td>
                                                        <td>{{ '$'.$product->pivot->total_value }}</td>
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
                                                    <p> {{ '$'.$invoice->subtotal }}</p>
                                                    <p> {{'$'.$invoice->vat }}</p>
                                                    <p> {{'$'.$invoice->total }}</p>
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
        </div>
    </div>
</div>
@endsection