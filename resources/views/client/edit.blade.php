@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i class="fas fa-undo"></i> atrás</a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header text-center">
            <b>Editar Cliente</b>
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
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Apellido</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $client->last_name }}" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tipo de Documento: </label>
                            <select class="form-control" name="id_type" value="{{ $client->id_card }}">
                                <option value="CC"> Cedula de ciudadania </option>
                                <option value="CE"> Cédula de extranjeria </option>
                                <option value="P"> Pasaporte </option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_card">Número de Documento: </label>
                            <input type="text" value="{{ $client->id_card }}" class="form-control" id="id_card" name="id_card" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" placeholder="Correo Electrónico">
                        </div>
                        <div class="form-group">
                            <label for="cellphone">Celular</label>
                            <input type="number" class="form-control" id="cellphone" name="cellphone" value="{{ $client->cellphone }}" placeholder="0">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="country">País</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ $client->country }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">Ciudad</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $client->city }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $client->address }}" placeholder="Dirección">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection