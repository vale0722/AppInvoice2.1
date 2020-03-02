<div class="table-responsive">
    <table class="table col-md-12 table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">CÓDIGO</th>
                <th scope="col">Creación</th>
                <th scope="col">Título</th>
                <th scope="col">Cliente</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Estado</th>
                <th scope="col">Total</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
            <tr>
                <td>{{ $invoice->code }}</td>
                <td nowrap>{{ $invoice->created_at }}</td>
                <td>{{ $invoice->title }}</td>
                <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                <td> {{ $invoice->company->name }}</td>
                <td>
                    @if($invoice->state == 'APPROVED')
                    <button type="button" class="btn btn-success btn-sm"> Pago </button>
                    @elseif($invoice->duedate <= $now) <button type="button" class="btn btn-danger btn-sm"> Vencido </button>
                    @elseif($invoice->state == 'PENDING') <button type="button" class="btn btn-primary btn-sm"> Pendiente </button>
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm">Sin Pagar </button>
                                    @endif
                </td>
                <td>{{ '$'. number_format($invoice->total, 2) }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"><i class="far fa-edit"></i> Editar </a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                            <i class="far fa-trash-alt"></i> Eliminar
                        </a>
                        @include('invoice.confirmDelete')
                        <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td> NO SE ENCUENTRAN FACTURAS </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $invoices->appends($_GET)->links() }}
</div>