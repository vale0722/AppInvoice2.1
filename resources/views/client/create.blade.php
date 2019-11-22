@extends ('layouts.base')
@section('title') NEW CLIENT @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>New Client</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/clients">back</a>
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
        <form action="/clients" method="POST">
        @csrf 
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-6">
                <label for="last_name">Last name</label>
                <input type="text" value="{{ old('last_name') }}" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                    <label>ID type: </label>
                        <select class="form-control" name= "id_type">
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
                <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="cellphone">Cellphone</label>
                <input type="number" value="{{ old('cellphone') }}" class="form-control" id="cellphone" name="cellphone" placeholder="Cellphone">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="country">Country</label>
                <input type="text" value="{{ old('country') }}" class="form-control" id="country" name="country">
                </div>
                <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" value="{{ old('country') }}" class="form-control" id="city" name="city">
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" value="{{ old('address') }}" class="form-control" id="address" name="address" placeholder="cll. 123 # 12-3">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection