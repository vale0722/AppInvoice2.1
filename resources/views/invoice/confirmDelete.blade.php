@extends ('layouts.app')
@section('title') DELETE INVOICE {{ $invoice->id }} @endsection
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary" href="/invoices">Back</a>
                <br>
                <br>
            </div>
        </div>
        <div class="card">
            <div class="row">
                <div class="col text-center">
                    <div class="card-header">
                        ARE YOU SURE?
                    </div>
                    <br>
                    <form action="/invoices/{{ $invoice->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>                    
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection