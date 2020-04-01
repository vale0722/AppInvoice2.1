@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
@if(session()->has('exportInProccess'))
<div id="exportInProccess">
</div>
@endif
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <div class="btn-group" role="group">
                <a type="button" class="btn btn-success btn-sm" href="{{ route('report.export', [$firstCreationDate, $finalCreationDate,'xlsx', $state]) }}"> <i class="fas fa-file-excel"></i> Exportar .xlsx</a>
                <a type="button" class="btn btn-warning btn-sm" href="{{ route('report.export', [$firstCreationDate, $finalCreationDate, 'csv', $state]) }}"> <i class="fas fa-file-csv"></i> Exportar .csv</a>
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('report.export', [$firstCreationDate, $finalCreationDate, 'tsv', $state]) }}"> <i class="far fa-file-alt"></i> Exportar .txt</a>
            </div>
        </div>
    </div>
</div>
<div class="container" style="max-width: 1200px">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3 ">
            <div class="text-center"><i class="fas fa-users"></i><b> REPORTE </b></div>
        </div>
        <div class="card-body">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->code }}</td>
                            <td nowrap>{{ $invoice->created_at }}</td>
                            <td>{{ $invoice->title }}</td>
                            <td> {{ $invoice->client->user->name . ' ' .$invoice->client->user->lastname }}</td>
                            <td> {{ $invoice->creator->name . ' ' .$invoice->creator->lastname }}</td>
                            <td>
                                @if($invoice->isApproved())
                                <span class="badge badge-success">Pago</span>
                                @elseif($invoice->isAnnuled())
                                <a class="badge badge-danger text-white"> ANULADA</a>
                                @elseif($invoice->duedate <= $now) <span class="badge badge-danger">Vencido</span>
                                    @elseif($invoice->isPending())
                                    <span class="badge badge-primary">Pendiente</span>
                                    @else
                                    <span class="badge badge-warning">Sin Pagar </span>
                                    @endif
                            </td>
                            <td>{{ '$'. number_format($invoice->total, 2) }}</td>
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
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $invoices->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection