@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="{{ route('companies.index') }}"><i class="fas fa-undo"></i> atrás</a>
        </div>
    </div>
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
            <div class="card">
                 <div class="card-header text-center"> <b>NUEVA COMPAÑIA</b></div>
                <br>
                <div class="col">
                    <form action="{{ route('companies.index') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name"> Nombre</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nit"> Nit</label>
                                <input type="text" value="{{ old('nit') }}" class="form-control" id="nit" name="nit" placeholder="Nit">
                            </div>
                        </div>
                        <div class="form-group text_center">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
                        </div>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection