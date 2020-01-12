@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <br>
    <br>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-3 border-left-primary py-2">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <p class="h3"> <i class="far fa-file-alt"></i><br>FACTURAS</p>
                                    <p>Aquí podrás crear, ver, actualizar y eliminar facturas.</p>
                                    <a class="btn btn-primary" href="{{ route('invoices.index') }}"> ENTRAR </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-4">
                    <div class="card o-hidden border-0 shadow my-3">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <p class="h3"> <i class="fas fa-users"></i><br>CLIENTES</p>
                                            <p>Aquí podrás crear, ver, actualizar y eliminar clientes.</p>
                                            <a class="btn btn-primary" href="{{ route('clients.index') }}"> ENTRAR </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="card o-hidden border-0 shadow my-3">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <p class="h3"> <i class="fas fa-puzzle-piece"></i><br> PRODUCTOS</p>
                                            <p>Aquí podrás crear, ver, actualizar y eliminar productos.</p>
                                            <a class="btn btn-primary" href="{{ route('products.index') }}"> ENTRAR </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="card border-0 shadow my-3">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
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
            </div>
        </div>
    </div>
</div>
@endsection