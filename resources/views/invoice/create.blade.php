@extends ('layouts.base')
@section('title') NEW INVOICE @endsection
@section('content')
    <div class="row">
        <div class="col text-center">
            <h1>New Invoice</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <a class="btn btn-secondary" href="/invoices">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="/invoices" method="POST">
                <div class="form-group">
                    <label for="input_title">Title </label>
                    <input type="text" class="form-control" id="input_title" name="input_title" placeholder="title">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection