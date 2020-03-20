@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-3">
                <div class="card-header">
                    <div class="text-center"><i class="fas fa-user"></i><b><br> PERFIL DE USUARIO</b></div>
                    <div>
                        @role('client')
                        <a class="btn btn-warning btn-circle btn-lg" href="{{ route('clients.edit', $user->client) }}"><i class="fas fa-pen"></i></a>
                        @else
                        <a class="btn btn-warning btn-circle btn-lg" href="{{ route('users.edit', $user) }}"><i class="fas fa-pen"></i></a>
                        @endrole
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="card-body p-4">
                            <div class="col">
                                <h5><b>Nombre:</b> {{ $user->name .' '. $user->lastname }}</h5>
                                <h5><b>Correo Electrónico:</b> {{ $user->email }} </h5>
                                <h5><b>Fecha de creación:</b> {{ $user->created_at }} </h5>
                                <h5><b>Ultima modificación:</b> {{ $user->updated_at }} </h5>
                                <h5>
                                    <b>Roles:</b>
                                    @foreach($user->roles as $role)
                                    {{ $role->description .' ' }}
                                    @endforeach
                                </h5>
                                @role('client')
                                <h5><b>Identificación: </b> {{ $user->client->id_type . ': ' . $user->client->id_card }}
                                    <h5><b>Celular:</b> {{ $user->client->cellphone }} </h5>
                                    <h5><b>Creado por:</b> {{ $user->client->creator->name }} </h5>
                                    <div class="text-right">
                                        <h5><b>Ubicación:</b> {{ $user->client->address }} </h5>
                                        <h5><b>{{ $user->client->country .'-'. $user->client->city .'-'.  $user->client->department}}</b></h5>
                                    </div>
                                    @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection