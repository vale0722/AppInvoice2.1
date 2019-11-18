@extends ('layouts.base')
@section('title') CLIENTS @endsection
@section('content')
    <div class="row col-md-6">
        <div class="col">
        <a class="btn btn-primary" href="/clients/create">Create a new client</a>
        <a class="btn btn-primary" href="/invoices">View Invoices</a>
        <br>
        <br>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cellphone</th>
                    <th scope="col">Country</th>
                    <th scope="col">City</th>
                    <th scope="col">Address</th>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
        @foreach($client as $client)
                <tbody>
                    <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->cellphone }}</td>
                    <td>{{ $client->country }}</td>
                    <td>{{ $client->city }}</td>
                    <td>{{ $client->address }}</td>
                    <td><a class="btn btn-warning" href="/clients/{{ $client->id }}/edit">Edit</a></td>
                    <td><a class="btn btn-danger" href="/clients/{{ $client->id }}/confirmDelete">Delete</a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection