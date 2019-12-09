@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-circle btn-lg btn-secondary" href="/invoices/{{ $invoice->id }}"><i class="fas fa-undo"></i></a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"> Agrega una nueva compra a la factura!</h1>
                            </div>
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
                            </div>
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
<<<<<<< HEAD
                        <input type="hidden" class="form-control" id="subtotal" name="subtotal" value="{{ $invoice->subtotal }}">
                        <input type="hidden" class="form-control" id="total" name="total" value="{{ $invoice->total }}">
                        <input type="hidden" class="form-control" id="vat" name="vat" value="{{ $invoice->vat }}">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                    </form>
=======
                        <br>
                    </div>
>>>>>>> 346fc29284f837a3784bf923dd149fdbdf802195
                </div>
            </div>
        </div>
    </div>
</div>
@endsection