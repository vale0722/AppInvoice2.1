@extends ('layouts.app')
@section('title') NEW INVOICE @endsection
@section('content')
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/invoices">Back</a>
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
        <br>
            <div class="col">
                <form action="/invoices" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title: </label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="code">Code: </label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="code" value="{{ old('code') }}">
                    </div>
                    <div class="form-group">
                        <label>Client: </label>
                        <select name="client_id" id="client_id" class="form-control @error('client') is-invalid @enderror">
                            @foreach($clients as $client)
                            <option value='{{ $client->id }}'> {{ $client->id_type . ' ' . $client->id_card . ': ' . $client->name . ' ' . $client->last_name  }} </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <br>
    </div>
</div>

@endsection