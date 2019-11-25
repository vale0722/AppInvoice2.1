@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary" href="{{ route('companies.index') }}"><i class="fas fa-undo"></i> atrás</a>
                <br>
                <br>
            </div>
        </div>
        <div class="card">      
        <div class="card-header">
                        ¿Estás realmente seguro?
                    </div>
            <div class="row">
                <div class="col text-center">
                    <br>
                    <form action="/companies/{{ $company->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> ELIMINAR</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection