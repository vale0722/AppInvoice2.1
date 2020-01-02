@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-circle btn-lg btn-secondary" href="{{ route('clients.index') }}"><i class="fas fa-undo"></i></a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('IMPORTA CLIENTES DESDE UN ARCHIVO EXCEL') }}</h1>
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
                                </div>
                            </div>
                            <div class="col text-center my-3">
                                <form action="{{ route('clients.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file" title="Selecciona un archivo">
                                        <label class="custom-file-label" for="file"  data-browse="Elegir">Selecciona un archivo .xls</label>
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

