@extends ('layouts.app')
@section('title') DELETE CLIENT @endsection
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary" href="/clients">back</a>
                <br>
                <br>
            </div>
        </div>
        <div class="card">      
        <div class="card-header">
                        ARE YOU SURE?
                    </div>
            <div class="row">
                <div class="col text-center">
                    <br>
                    <form action="/clients/{{ $client->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection