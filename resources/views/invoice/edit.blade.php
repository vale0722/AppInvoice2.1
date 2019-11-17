@extends ('layouts.base')
@section('title') EDIT INVOICE @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Edit Invoice {{ $invoice->id }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/invoices">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="/invoices/{{ $invoice->id }}" method="POST">
             @csrf 
             @method('put')
                <div class="form-group">
                    <label for="input_title"> Title </label>
                    <input type="text" class="form-control" id="input_title" name="input_title" value="{{ $invoice->title }}" placeholder="title">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection