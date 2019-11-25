@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="{{ route('invoices.index') }}"><i class="fas fa-undo"></i> atrás</a>
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
        </div>
    </div>
    <div class="card">
        <div class="card-header text-center"> <b>NUEVA FACTURA</b></div>
        <br>
        <div class="col">
            <form action="{{ route('invoices.index') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Título: </label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="título" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="code">Código: </label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="código" value="{{ old('code') }}">
                </div>
                <div class="form-group">
                    <label>Cliente: </label>
                    <select name="client_id" id="client_id" class="form-control @error('client') is-invalid @enderror">
                        @foreach($clients as $client)
                        <option value='{{ $client->id }}'> {{ $client->id_type . ' ' . $client->id_card . ': ' . $client->name . ' ' . $client->last_name  }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Vendedor: </label>
                    <select name="company_id" id="company_id" class="form-control @error('company') is-invalid @enderror">
                        @foreach($companies as $company)
                        <option value='{{ $company->id }}'> {{ $company->nit . ': ' . $company->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                </div>
            </form>
        </div>
        <br>
    </div>
</div>

@endsection