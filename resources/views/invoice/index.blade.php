@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
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
</div>
<div class="container" style="max-width: 1200px">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3 ">
            <div class="text-center"><i class="fas fa-users"></i><b> FACTURAS </b></div>
            <div>
                <div>
                    <a class="btn btn-primary btn-circle btn-lg" href="/invoices/create"><i class="fas fa-plus"></i></a>
                    <a class="btn btn-success btn-circle btn-lg" href="{{ route('invoices.import.view') }}"><i class="fas fa-file-import"></i></a>
                    <a class="btn btn-warning btn-circle btn-lg" data-toggle="modal" data-target="#exportForm"><i class="fas fa-file-export"></i></a>
                    <a class="btn btn-danger btn-circle btn-lg" href="{{ route('invoices.updates') }}"><i class="far fa-hand-point-up"></i></a>
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