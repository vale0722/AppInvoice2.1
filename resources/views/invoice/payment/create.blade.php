<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $invoice->title }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span> × </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="row"> Nombre del cliente</div>
                            <div class="row"> Documento de Identidad</div>
                            <div class="row"> Correo Electronico</div>
                            <div class="row"> Código de Factura</div>
                            <div class="row"> Monto </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> {{$invoice->client->name .' '. $invoice->client->last_name}}</div>
                            <div class="row"> {{$invoice->client->id_type .' '. $invoice->client->id_card}}</div>
                            <div class="row"> {{$invoice->client->email}}</div>
                            <div class="row"> {{$invoice->code}}</div>
                            <div class="row"> {{'$'. number_format($invoice->total)}} </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('payments.store', $invoice) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-block"> confirmar </button>
            </form>
        </div>
    </div>
</div>