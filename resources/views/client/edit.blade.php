@extends ('layouts.base')
@section('title') EDIT CLIENT @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Edit Client</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/clients">back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <form action="/clients/{{ $client->id }}" method="POST">
        @csrf 
        @method('put')
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="input_name">Name</label>
                <input type="text" class="form-control" id="input_name" name="input_name" value="{{ $client->name }}" placeholder="Name">
                </div>
                <div class="form-group col-md-6">
                <label for="input_last_name">Last_name</label>
                <input type="text" class="form-control" id="input_last_name" name="input_last_name" value="{{ $client->last_name }}" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <label for="input_email">Email</label>
                <input type="email" class="form-control" id="input_email" name="input_email" value="{{ $client->email }}" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="input_cellphone">Cellphone</label>
                <input type="number" class="form-control" id="input_cellphone" name="input_cellphone" value="{{ $client->cellphone }}" placeholder="Cellphone">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="input_country">Country</label>
                <input type="text" class="form-control" id="input_country" name="input_country" value="{{ $client->country }}">
                </div>
                <div class="form-group col-md-6">
                <label for="input_city">City</label>
                <input type="text" class="form-control" id="input_city" name="input_city" value="{{ $client->city }}">
                </div>
            </div>
            <div class="form-group">
                <label for="input_address">Address</label>
                <input type="text" class="form-control" id="input_address" name="input_address" value="{{ $client->address }}" placeholder="cll. 123 # 12-3">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection