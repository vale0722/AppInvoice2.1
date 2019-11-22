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
            <form action="/invoices/{{ $invoice->id }}/invoice_product" method="POST">
             @csrf 
                <div class="form-row">
                <div class="form-group col-4">
                        <label for="invoice_id"> Invoice ID: </label>
                        <input type="number"  readonly="readonly" class="form-control" id="invoice_id" name="invoice_id" placeholder="0" value="{{ $invoice->id }}">
                    </div>
                    <div class="form-group col-4">
                        <label for="quantity">Quantity: </label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0" value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group col-4">
                        <label for="unit_value">Unit value: </label>
                        <input type="number" class="form-control" id="unit_value" name="unit_value" placeholder="0" value="{{ old('unit_value') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="product">Product: </label>
                        <select name="product_id" id="product_id" class="form-control @error('product') is-invalid @enderror" >
                            @foreach($products as $product)
                                <option value='{{ $product->id }}'> {{ $product->code . ': ' . $product->name }} </option>
                            @endforeach
                         </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection