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
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Crea un nuevo cliente') }}!</h1>
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
                            <form action="{{ route('clients.index') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_name">Apellido</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name')}}" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Documento: </label>
                                    <select class="form-control" name="id_type">
                                        <option value="CC"> Cedula de ciudadania </option>
                                        <option value="CE"> Cédula de extranjeria </option>
                                        <option value="P"> Pasaporte </option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_card">Número de Documento: </label>
                                    <input type="text" value="{{ old('id_card') }}" class="form-control" id="id_card" name="id_card" placeholder="0">
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico">
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Celular</label>
                                    <input type="number" class="form-control" id="cellphone" name="cellphone" value="{{ old('cellphone') }}" placeholder="0">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="country">País</label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" placeholder="País">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city">Ciudad</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="Ciudad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Dirección">
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