@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/invoices/{{ $invoice->id }}"><i class="fas fa-undo-alt"></i> Atrás</a>
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
            <div class="card">
                <div class="card-header text-center"><b><i class="fas fa-shopping-basket"></i> NUEVO PRODUCTO EN LA FACTURA</b></div>
                <br>
                <div class="col">
                    <form action="/invoices/{{ $invoice->id }}/invoice_product" method="POST">
                        @csrf
                        <div class="form-group col-4">
                                <input type="hidden" readonly="readonly" class="form-control hidden" id="invoice_id" name="invoice_id" placeholder="0" value="{{ $invoice->id }}">
                            </div>
                        <div class="form-row">
                            
                            <div class="form-group col-6">
                                <label for="quantity">Cantidad: </label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0" value="{{ old('quantity') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="unit_value">Precio unitario: </label>
                                <input type="number" class="form-control" id="unit_value" name="unit_value" placeholder="0" value="{{ old('unit_value') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="product">Producto: </label>
                                <select name="product_id" id="product_id" class="form-control @error('product') is-invalid @enderror">
                                    @foreach($products as $product)
                                    <option value='{{ $product->id }}'> {{ $product->code . ': ' . $product->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection