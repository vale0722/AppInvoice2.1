@extends('layouts.app')
@section('content')
<div class="container" style=" padding-right: 0px; padding-left: 150px;">
    @if(session()->has('message'))
    <div class="alert alert-success" id="message">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="card shadow mb-5 my-5">
        <div class="card-header">
            <div class="text-center">
                <h4> Historico de intentos de pago de la factura {{ $invoice->code }}</h4>
            </div>
            <div>
                <a class="btn btn-success btn-circle btn-lg" href="{{ route('invoices.show', $invoice->id) }}"><i class="fas fa-undo"></i></a></div>
        </div>
        <div class="card-body">
            <div class=" table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo de factura</th>
                            <th>fecha de intento</th>
                            <th>estado del intento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->payments as $payment)
                        <tr>
                            <td>{{ $invoice->code }}</td>
                            <td><a href="{{ route('payments.show', $payment->id) }}">{{ $payment->created_at }}</a></td>
                            <td>{{ $payment->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>