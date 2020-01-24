@extends ('layouts.app')
@section('content')
<div class="card-body">
    <div class="table-responsive">
        <table class="table col-md-12 table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">Id de la factura </th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->code }}</td>
                    <td>{{ $payment->status }}</td>
                </tr>
            </tbody>
        </table>
    </div>