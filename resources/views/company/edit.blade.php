@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="{{ route('companies.index') }}"><i class="fas fa-undo"></i> atrás</a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header text-center">
            <b>Editar Compañia</b>
        </div>
        <div class="col">
            <br>
            <div class="row">
                <div class="col">
                    <br>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="/companies/{{ $company->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name"> Nombre</label>
                                <input type="text" value="{{ $company->name }}" class="form-control" id="name" name="name" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nit"> Nit</label>
                                <input type="text" value="{{ $company->nit }}" class="form-control" id="nit" name="nit" placeholder="Nit">
                            </div>
                        </div>
                        <div class="form-group text_center">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection