@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="container">
    <div class="card o-hidden border-0 shadow my-3 border-left-primary py-2">
        <div class="card-body p-0">
            <div class="text-center">
                <p class="h1"> <i class="far fa-file-alt"></i><br>BIENVENID@</p>
            </div>
        </div>
    </div>
    <div class="row">´
        <div class="col col-lg-1">
        </div>
        @can('view all clients')
        <div class="col col-lg-3">
            <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                        </div>
                        <div class="content">
                            <div class="main">
                                <h2 class="name">Clientes</h2>
                                <h2 class="name"><i class="fas fa-users"></i></h2>
                            </div>
                            <div class="footer">
                                <div class="rating">
                                    <i class="fa fa-mail-forward"></i> Rotar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="back">
                        <div class="content">
                            <div class="main center">
                                <h4 class="text-center">Clientes</h4>
                                <p class="text-center">Aquí podrás crear, ver, actualizar y eliminar clientes.</p>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="social-links text-center">
                                <a class="btn btn-primary" href="{{ route('clients.index') }}"> ENTRAR </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('view all products')
        <div class="col col-lg-3">
            <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                        </div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name">Productos</h3>
                                <h3 class="name"><i class="fas fa-puzzle-piece"></i></h3>
                            </div>
                            <div class="footer">
                                <div class="rating">
                                    <i class="fa fa-mail-forward"></i> Rotar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="back">
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Productos</h4>
                                <p class="text-center">Aquí podrás crear, ver, actualizar y eliminar productos.</p>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="social-links text-center">
                                <a class="btn btn-primary" href="{{ route('products.index') }}"> ENTRAR </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('viewAny', App\Invoice::Class)
        @hasrole('client')
        <div class="col col-lg-3">
        </div>
        <div class="col col-lg-4">
            @else
            <div class="col col-lg-3">
                @endhasrole
                <div class="card-container">
                    <div class="card">
                        <div class="front">
                            <div class="cover">
                            </div>
                            <div class="user">
                            </div>
                            <div class="content">
                                <div class="main">
                                    <h3 class="name">Facturas</h3>
                                    <h3 class="name"><i class="fas fa-users"></i></h3>
                                </div>
                                <div class="footer">
                                    <div class="rating">
                                        <i class="fa fa-mail-forward"></i> Rotar
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="content">
                                <div class="main">
                                    <h4 class="text-center">Facturas</h4>
                                    <p class="text-center">Aquí podrás crear, ver, actualizar y eliminar facturas.</p>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="social-links text-center">
                                    <a class="btn btn-primary" href="{{ route('invoices.index') }}"> ENTRAR </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            <div class="col col-lg-2">
            </div>
        </div>
        @endsection