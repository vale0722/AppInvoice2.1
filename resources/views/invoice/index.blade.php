@extends ('layouts.base')
@section('title') INVOICES @endsection
@section('content')
    <div class="row">
        <div class="col ">
        <a class="btn btn-primary" href="/invoices/create">Create a new invoice</a>
        <a class="btn btn-primary" href="/clients">View Clients</a>
        <br>
        <br>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 table-responsive">
        <table class="table">
            <thead>
                 <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
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
                    <td>{{ $invoice->created_at }}</td>
                    <td><a class="btn btn-warning" href="/invoices/{{ $invoice->id }}/edit"> Edit </a></td>
                    <td><a class="btn btn-danger" href="/invoices/{{ $invoice->id }}/confirmDelete">Delete</a></td>
                    </tr>
                </tbody>  
                @endforeach
            </table>
        </div>
    </div>
@endsection