@extends ('layouts.app')
@section('title') PRODUCT @endsection
@section('content')

<div class="container">
    <div class="row ">
        <div class="col">
            <a class="btn btn-primary" href="/products/create">Create a new product</a>
            <a class="btn btn-primary" href="/invoices">View Invoices</a>
            <a class="btn btn-primary" href="/clients">View Clients</a>
            <br>
            <br>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-center"> <b>PRODUCTS</b></div>
        <div class="col">
            <div class="row col-md-12">
                <div class="col">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($product as $product)
                        <tbody>
                            <tr>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ '$'.$product->price }}</td>
                                <td><a class="btn btn-warning" href="/products/{{ $product->id }}/edit">Edit</a></td>
                                <td><a class="btn btn-danger" href="/products/{{ $product->id }}/confirmDelete">Delete</a></td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection