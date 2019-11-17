@extends ('layouts.base')
@section('title') DELETE INVOICE @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Delete Invoice {{ $invoice->id }}</h1>
        </div>
    </div>
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