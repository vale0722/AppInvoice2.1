@extends ('layouts.base')
@section('title') EDIT CLIENT @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>Edit Client</h1>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
        <a class="btn btn-secondary" href="/clients">back</a>
        <br>
        <br>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
        <h1>ARE YOU SURE?</h1>
        <br>
        <form action="/clients/{{ $client->id }}" method="POST">
            @csrf 
            @method('delete')
            <button type="submit" class="btn btn-danger">DELETE</button>
        </form>
        </div>
    </div>
@endsection