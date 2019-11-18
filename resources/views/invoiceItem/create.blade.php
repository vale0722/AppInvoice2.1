@extends ('layouts.base')
@section('title') NEW INVOICE ITEM @endsection
@section('content')
    <div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/invoices/{{ $invoice->id }}">Back</a>
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
            <form action="/invoices/{{ $invoice->id }}/invoiceItems" method="POST">
             @csrf 
                <div class="form-row">
                <div class="form-group col-4">
                        <label for="input_invoice_id"> Invoice ID: </label>
                        <input type="number"  readonly="readonly" class="form-control" id="input_invoice_id" name="input_invoice_id" placeholder="0" value="{{ $invoice->id }}">
                    </div>
                    <div class="form-group col-4">
                        <label for="input_quantity">Quantity: </label>
                        <input type="number" class="form-control" id="input_quantity" name="input_quantity" placeholder="0" value="{{ old('input_quantity') }}">
                    </div>
                    <div class="form-group col-4">
                        <label for="input_unit_value">Unit value: </label>
                        <input type="number" class="form-control" id="input_unit_value" name="input_unit_value" placeholder="0" value="{{ old('input_unit_value') }}">
                    </div>
                </div>
                <div class="form-row">
                <div class="form-group col-12">
                <label for="input_description">Description: </label>
                        <input type="text" class="form-control" id="input_description" name="input_description" placeholder="description" value="{{ old('input_description') }}">
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection