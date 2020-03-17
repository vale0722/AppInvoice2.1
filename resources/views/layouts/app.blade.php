<?php

/**
 * Invoice control system that incorporates all the requirements contained in the trade code (Art 774)
 *
 * @author Valeria Granada Rodas <vale_0722@live.com>
 * @copyright 2019 Valeria Granada Rodas
 * @version 2019-11-25
 */
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ('SISTEMA DE FACTURACIÓN') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d113d634ed.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ mix('css/buttons.css') }}" rel="stylesheet">
    <link href="{{ mix('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        @guest
        @if (Route::has('register'))
        @endif
        @else
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white">
            <div class="sidenav-header  align-items-center">
                <a class="navbarbrand" href="{{ route('home') }}">
                    SISTEMA DE FACTURACIÓN
                </a>
            </div>

            <div class="navbar">
                <ul class="navbar-nav">
                    @if(auth()->user()->can('view all invoices') || auth()->user()->can('view associated invoices'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('invoices.index') }}">
                            <i class="far fa-file-alt text-primary"></i>
                            <span class="nav-link-text"> Facturas</span>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('view all clients'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.index') }}">
                            <i class="fas fa-users text-primary"></i>
                            <span class="nav-link-text"> Clientes</span>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('view all products'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">
                            <i class="fas fa-puzzle-piece text-primary"></i>
                            <span class="nav-link-text"> Productos</span>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->can('view all users'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="fas fa-users text-primary"></i>
                            <span class="nav-link-text"> Usuarios</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <div class="active-pro">
                <br>
                <h5 class="navbar-heading p-0 text-center text-primary">
                    <i class="fas fa-user "></i> {{ Auth::user()->name }}
                </h5>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-user"></i>
                            <span class="nav-link-text">Mi perfil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-link-text">Cerrar Sesión</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

        </nav>
        @endguest
        <div class="main-content">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/alerts.js') }}" defer></script>
    <script src="{{ mix('js/bootstrap.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script>
</body>