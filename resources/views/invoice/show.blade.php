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
    <div class="col col-4">
        <h5> Company name:</h5> <input type="text" value="" readonly="readonly">
    </div>
    <div class="col col-4">
        <h5> Nit:</h5> <input type="text" value="" readonly="readonly">
        <hr>
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
        <h5>Client: </h5> <input type="text" value="" readonly="readonly"></input>
    </div>
    <hr>
</div>
<br>
    <div class="row">
        <div class="col col-md-12 table-responsive-sm">
        <table class="table">
            <thead>
                 <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit value</th>
                    <th scope="col">Id</th>
                    <th scope="col">Description</th>
                    <th scope="col">Total Value</th>
                 </tr>
                </thead>
                <tbody>
                @foreach($invoice->invoiceItems as $invoice)
                    <tr>
                    <td>{{ $invoice->description }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>{{ $invoice->unit_value }}</td>
                    <td>{{ $invoice->description }}</td>
                    <td>{{ $invoice->total_value }}</td>
                    </tr>
                @endforeach
                </tbody>  
                
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
        <br>
        <a class="btn btn-primary" href="/invoices/{{ $invoice->id }}/invoiceItems/create">Create a new item</a>
        </div>
    </div>
@endsection