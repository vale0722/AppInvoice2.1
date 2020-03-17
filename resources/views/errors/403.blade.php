@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow my-5">
        <div class="row justify-content-center">
            <br /><br /><br />
            <div class="text-center">
                <div class="card-body">
                    <h1 class="card-title display-1">403</h1>
                    <p class="card-text">No tienes permiso para acceder a esta página.</p>
                    <br /><br />

                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-4 col-md-offset-4">
                <a href="{{ route('home') }}" class="text-dark"><i class="fas fa-undo"></i> Vuelve a la página principal.</a>
            </div>
        </div>
    </div>
</div>
@endsection