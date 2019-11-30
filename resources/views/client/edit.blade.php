@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-circle btn-lg btn-secondary" href="{{ route('clients.index') }}"><i class="fas fa-undo"></i></a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Edita el cliente') }}:</h1>
                            </div>
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
                            </div>
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
                                        @if ($client->id_type == "CC")
                                        <option value='CC' selected> Cedula de ciudadania </option>
                                        @elseif($client->id_type == "CE")
                                        <option value='CE' selected> Cédula de extranjeria </option>
                                        @else
                                        <option value="P" selected> Pasaporte </option>
                                        @endif
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
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection