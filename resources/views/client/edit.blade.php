@extends ('layouts.app')
@section('title') EDIT CLIENT @endsection
@section('content')
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/clients">back</a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header text-center"> 
        <b>Edit Client</b>
        </div>
        <div class="col">
        <br>
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
                <form action="/clients/{{ $client->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $client->last_name }}" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ID type: </label>
                        <select class="form-control" name="id_type">
                            <option value="CC"> Cedula de ciudadania </option>
                            <option value="CE"> Cédula de extranjeria </option>
                            <option value="P"> Pasaporte </option>
    
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_card">Identification number</label>
                        <input type="text" value="{{ old('id_card') }}" class="form-control" id="id_card" name="id_card" placeholder="0000000000">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="cellphone">Cellphone</label>
                        <input type="number" class="form-control" id="cellphone" name="cellphone" value="{{ $client->cellphone }}" placeholder="Cellphone">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ $client->country }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $client->city }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $client->address }}" placeholder="cll. 123 # 12-3">
                    </div>
                    <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
    </div>
</div>

@endsection