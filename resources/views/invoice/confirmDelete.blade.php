@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary" href="{{ route('invoices.index') }}"><i class="fas fa-undo"></i> atrás</a>
                <br>
                <br>
            </div>
        </div>
        <div class="card">
            <div class="row">
                <div class="col text-center">
                    <div class="card-header">
                        ¿Estás realmente seguro?
                    </div>
                    <br>
                    <form action="/invoices/{{ $invoice->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>ELIMINAR</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection