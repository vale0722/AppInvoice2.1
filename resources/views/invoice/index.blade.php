@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
<div class="container" style="max-width: 1200px">
    @include('invoice.filtration')
    @if(session()->has('success'))
    <div class="alert alert-success" id="success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('errorEdit'))
    <div class="alert alert-success" id="errorEdit">
    </div>
    @endif
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3 ">
            <div class="text-center"><i class="fas fa-users"></i><b> FACTURAS </b></div>
            <div>
                <div>
                    @can('invoices.create')
                    <a class="btn btn-primary btn-circle btn-lg" href="/invoices/create"><i class="fas fa-plus"></i></a>
                    @endcan
                    @can('invoices.import')
                    <a class="btn btn-success btn-circle btn-lg" href="{{ route('invoices.import.view') }}"><i class="fas fa-file-import"></i></a>
                    @endcan
                    @can('invoices.export')
                    <a class="btn btn-warning btn-circle btn-lg" data-toggle="modal" data-target="#exportForm"><i class="fas fa-file-export"></i></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('invoice.tableInvoice')
        </div>
    </div>
</div>
@include('invoice.exportForm')
@endsection