@extends ('layouts.base')
@section('title') DELETE INVOICE {{ $invoice->id }} @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
        <a class="btn btn-secondary" href="/invoices">Back</a>
        <br>
        <br>
        </div>
    </div>
    <div class="row">
        
        <div class="col text-center">
        <h3>ARE YOU SURE?</h3>
        <br>
            <form action="/invoices/{{ $invoice->id }}" method="POST">
             @csrf 
             @method('delete')
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </div>
@endsection