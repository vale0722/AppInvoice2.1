@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row text-center">
                        <div class="col-3">
                            <p class="h3"> <i class="far fa-file-alt"></i> FACTURAS</p>
                            <p>Aquí podrás crear, ver, actualizar y eliminar facturas.</p>
                            <a class="btn btn-primary" href="{{ route('invoices.index') }}"> ENTRAR </a>
                        </div>
                        <div class="col-3">
                            <p class="h3"> <i class="fas fa-users"></i> CLIENTES</p>
                            <p>Aquí podrás crear, ver, actualizar y eliminar clientes.</p>
                            <a class="btn btn-primary" href="{{ route('clients.index') }}"> ENTRAR </a>
                        </div>
                        <div class="col-3">
                            <p class="h3"> <i class="fas fa-puzzle-piece"></i> PRODUCTOS</p>
                            <p>Aquí podrás crear, ver, actualizar y eliminar productos.</p>
                            <a class="btn btn-primary" href="{{ route('products.index') }}"> ENTRAR </a>
                        </div>
                        <div class="col-3">
                            <p class="h3"> <i class="far fa-building"></i> VENDEDORES</p>
                            <p>Aquí podrás crear, ver, actualizar y eliminar vendedores.</p>
                            <a class="btn btn-primary" href="{{ route('companies.index') }}"> ENTRAR </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection