@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row text-center">
                        <div class="col-4">
                            <p class="h3"> <i class="far fa-file-alt"></i> INVOICES</p>
                            <p>Here you can create, view and update invoices.</p>
                            <a class="btn btn-primary" href="/invoices"> ENTER </a>
                        </div>
                        <div class="col-4">
                            <p class="h3"> <i class="far fa-file-alt"></i> CLIENTS</p>
                            <p>Here you can create, view and update clients.</p>
                            <a class="btn btn-primary" href="/clients"> ENTER </a>
                        </div>
                        <div class="col-4">
                            <p class="h3"> <i class="far fa-file-alt"></i> PRODUCTS</p>
                            <p>Here you can create, view and update products.</p>
                            <a class="btn btn-primary" href="/products"> ENTER </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection