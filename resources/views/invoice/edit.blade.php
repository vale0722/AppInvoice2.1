@extends ('layouts.base')
@section('title') EDIT INVOICE {{ $invoice->id }} @endsection
@section('content')
    <div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/invoices">Back</a>
        </div>
    </div>
    <div class="row">
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