@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow mb-4 my-5">
                <div class="card-body p-0">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Editar usuario') }}!</h1>
                            </div>
                            <form method="POST" action="{{ route('users.update', $user) }}">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" placeholder="Nombre" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" placeholder="Apellido" required autocomplete="lastname" autofocus>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico" value="{{ $user->email }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @role('admin')
                                <div class="form-group">
                                    <select name="role" class="form-control" id="role" rrequired autocomplete="role" autofocus required>
                                        <option disabled>Selecciona un rol: </option>
                                        @foreach($roles as $role)
                                        @if( $role->name != 'client' )
                                        @if($user->hasRole('admin'))
                                        @if( $role->name == 'admin')
                                        <option value="{{ $role->id }}" selected>{{ $role->description }}</option>
                                        @else
                                        <option value="{{ $role->id }}">{{ $role->description }}</option>
                                        @endif
                                        @else
                                        <option value="{{ $role->id }}" selected>{{ $role->description }}</option>
                                        @endif
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endrole
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('GUARDAR') }}
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection