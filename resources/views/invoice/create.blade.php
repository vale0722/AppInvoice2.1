@extends ('layouts.base')
@section('title') NEW INVOICE @endsection
@section('content')
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
            <form action="/invoices" method="POST">
             @csrf 
                <div class="form-group">
                    <label for="input_title">Title: </label>
                    <input type="text" class="form-control" id="input_title" name="input_title" placeholder="title" value="{{ old('input_title') }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection