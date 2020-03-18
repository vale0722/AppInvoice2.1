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
                <td> {{ $invoice->client->user->name . ' ' .$invoice->client->user->lastname }}</td>
                <td> {{ $invoice->creator->name . ' ' . $invoice->creator->lastname }}</td>
                <td>
                    @if($invoice->state == 'APPROVED')
                    <span class="badge badge-success">Pago</span>
                    @elseif($invoice->duedate <= $now) <span class="badge badge-danger">Vencido</span>
                        @elseif($invoice->state == 'PENDING')
                        <span class="badge badge-primary">Pendiente</span>
                        @else
                        <span class="badge badge-warning">Sin Pagar </span>
                        @endif
                </td>
                <td>{{ '$'. number_format($invoice->total, 2) }}</td>
                <td>
                    <div class="btn-group" role="group">
                        @can('update', $invoice)
                        @if ($invoice->state != 'APPROVED' && $invoice->state != 'PENDING' )
                        <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice) }}"><i class="far fa-edit"></i> Editar </a>
                        @endif
                        @endcan
                        @can('delete', $invoice)
                        <a href="{{ route('invoices.confirm.delete', $invoice) }}" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i> Eliminar
                        </a>
                        @endcan
                        @can('show', $invoice)
                        <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
                        @endcan
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center"> NO SE ENCUENTRAN FACTURAS </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $invoices->appends($_GET)->links() }}
</div>