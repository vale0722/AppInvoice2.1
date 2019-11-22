@extends ('layouts.base')
@section('title') INVOICE {{$invoice->title}} @endsection
@section('content')
<div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/invoices">Back</a>
        </div>
    </div>
    <br>
<div class="row">
    <div class="col col-6">
        <h5> Company name:</h5> <input type="text" value="" readonly="readonly">
    </div>
    <div class="col col-6">
        <h5> Nit:</h5> <input type="text" value="" readonly="readonly">
        
    </div>
</div>
<div class="row">
    <div class="col col-6">
        <h5> Subtotal:</h5> <input type="text" value="{{ $invoice->subtotal }}" readonly="readonly">
    </div>
    <div class="col col-6">
        <h5> Vat:</h5> <input type="text" value="{{ $invoice->vat }}" readonly="readonly">
    </div>
</div>
<div class="row">
    <div class="col col-4">
        <h5>Due Date: </h5> <input type="text" value="" readonly="readonly"></input>
    </div>
    <div class="col col-4">
    <h5>Creation date: </h5> <input type="text" value=" {{ $invoice->created_at }} " readonly="readonly"></input>
    </div>
    <div class="col col-4">
        <h5>Client: </h5> <input type="text" value="{{ $invoice->client_id }}" readonly="readonly"></input>
    </div>
    <hr>
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
                    <td>{{ $product->pivot->total_value }}</td>
                    </tr>
                @endforeach
                    <tr> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>subtotal</td>
                    <td>{{ $invoice->subtotal }}</td>
                    </tr>
                    <tr> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td>{{ $invoice->total }}</td>
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
@endsection