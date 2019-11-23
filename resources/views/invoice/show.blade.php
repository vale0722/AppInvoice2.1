@extends ('layouts.app')
@section('title')  {{$invoice->title}} @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/invoices">Back</a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="col">
            <br>
            <div class="row">
                <div class="col col-4">
                    <h5><b>Company:   </b> <input type="text" value="" readonly="readonly"></h5>
                </div>
                <div class="col col-4">
                    <h5><b> Nit:      </b> <input type="text" value="" readonly="readonly"></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <br>
            <div class="row">
                <div class="col col-4">
                    <h5> <b>Subtotal: </b><input type="text" value="{{ $invoice->subtotal }}" readonly="readonly"></h5> 
                </div>
                <div class="col col-4">
                    <h5><b>Vat:       </b> <input type="text" value="{{ $invoice->vat }}" readonly="readonly"></h5> 
                </div>
                <div class="col col-4">
                    <h5> <b>Total:    </b> <input type="text" value="{{ '$'.$invoice->total }}" readonly="readonly"></h5> 
                </div>
            </div>
        </div>
        <div class="col">
            <br>
            <div class="row">
                <div class="col col-4">
                    <h5><b>Due Date:      </b><input type="text" value="{{ $invoice->duedate }}" readonly="readonly"></input></h5> 
                </div>
                <div class="col col-4">
                    <h5><b>Creation date: </b><input type="text" value=" {{ $invoice->created_at }} " readonly="readonly"></input></h5> 
                </div>
                <div class="col col-4">
                    <h5><b>Client:        </b> <input type="text" value="{{ $invoice->client->name }}" readonly="readonly"></input></h5> 
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col col-md-12 table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit value</th>
                        <th scope="col">Total Value</th>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>subtotal</td>
                        <td>{{ '$'.$invoice->subtotal }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{'$'.$invoice->total }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <br>
            <a class="btn btn-primary" href="/invoices/{{ $invoice->id }}/invoice_product/create">Create a new item</a>
        </div>
    </div>
</div>
@endsection