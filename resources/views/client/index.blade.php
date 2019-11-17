@extends ('layouts.base')
@section('title') CLIENTS @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Clients</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a class="btn btn-primary" href="/clients/create">Create a new client</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection