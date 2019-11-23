@extends ('layouts.app')
@section('title') INVOICES @endsection
@section('content')

<div class="container">
    <div class=" row justify-content-center">
        <div class="col ">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <a class="btn btn-primary" href="/invoices/create">Create a new invoice</a>
            <a class="btn btn-primary" href="/clients">View Clients</a>
            <a class="btn btn-primary" href="/products">View Products</a>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Total Cost</th>
                            <th scope="col">Creation date</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($invoice as $invoice)
                    <tbody>
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td><a href="/invoices/{{ $invoice->id }}">{{ $invoice->title }}</a></td>
                            <td>{{ $invoice->total }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td><a class="btn btn-warning" href="/invoices/{{ $invoice->id }}/edit"> Edit </a></td>
                            <td><a class="btn btn-danger" href="/invoices/{{ $invoice->id }}/confirmDelete">Delete</a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection