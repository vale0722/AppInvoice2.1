<div class="modal fade " id="create">
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $invoice->title }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span> × </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    @if($invoice->state == 'PENDING')
                    <div class="alert alert-danger"> TIENES UN PAGO PENDIENTE DE APROBACIÓN </div>
                    @else
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="row"> Nombre del cliente</div>
                            <div class="row"> Documento de Identidad</div>
                            <div class="row"> Correo Electronico</div>
                            <div class="row"> Código de Factura</div>
                            @if($invoice->state != NULL)
                            <div class="row"> Estado de la factura </div>
                            @endif
                            <div class="row"> Monto </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> {{$invoice->client->user->name .' '. $invoice->client->user->lastname}}</div>
                            <div class="row"> {{$invoice->client->id_type .' '. $invoice->client->id_card}}</div>
                            <div class="row"> {{$invoice->client->user->email}}</div>
                            <div class="row"> {{$invoice->code}}</div>
                            @if($invoice->state != NULL)
                            <div class="row"> {{$invoice->state}} </div>
                            @endif
                            <div class="row"> {{'$'. number_format($invoice->total) . ' COP'}} </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('payments.store', $invoice) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-block"> confirmar </button>
            </form>
            @endif
        </div>
    </div>
</div>