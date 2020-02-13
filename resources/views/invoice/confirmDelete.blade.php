<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('¿Estás realmente seguro?') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span> × </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <span class="text-gray-900 mb-4">Si lo haces perderás todos los datos de la factura {{ $invoice->code }}</h1>
                </div>
            </div>
            <form action="/invoices/{{ $invoice->id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-block"><i class="far fa-trash-alt"></i> ELIMINAR</button>
            </form>
        </div>
    </div>
</div>