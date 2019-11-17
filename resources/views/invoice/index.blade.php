@extends ('layouts.base')
@section('title') INVOICE @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Invoices</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a class="btn btn-primary" href="/invoices/create">Create a new invoice</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table">
            <thead>
                 <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Creation date</th>
                 </tr>
                </thead>
            @foreach($invoice as $invoice)
                <tbody>
                    <tr>
                    <td>{{ $invoice->title }}</td>
                    <td>{{ $invoice->created_at }}</td>
                    </tr>
                </tbody>  
                @endforeach
            </table>
        </div>
    </div>
@endsection