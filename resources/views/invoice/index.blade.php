@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>

<div class="container">
    <div class="card mb-4 my-5">
        <div class="card-header py-3 ">
            @if(isset($type)||isset($typeDate)||isset($state))
            <a href="{{ route('invoices.index') }}" class="btn btn-circle btn-danger"><i class="fas fa-undo"></i> </button></a>
            @endif
            <div class="text-center"><i class="fas fa-search"></i><b> FILTRACIÓN </b></div>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.index') }}" method="GET">
                <div class="form-group">
                    <h5>Búsqueda por:</h5>
                    @if($type)
                    <div class="input-group">
                        <div class="col-sm-4">
                            @if($type == 'code')
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option value="code" selected>Código</option>
                                <option value="title">Títuto</option>
                                <option value="client">Cliente</option>
                                <option value="company">Vendedor</option>
                            </select>
                            @elseif($type == 'title')
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option value="code">Código</option>
                                <option value="title" selected>Títuto</option>
                                <option value="client">Cliente</option>
                                <option value="company">Vendedor</option>
                            </select>
                            @elseif($type == 'client')
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option value="code">Código</option>
                                <option value="title">Títuto</option>
                                <option value="client" selected>Cliente</option>
                                <option value="company">Vendedor</option>
                            </select>
                            @elseif($type == 'company')
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option value="code">Código</option>
                                <option value="title">Títuto</option>
                                <option value="client">Cliente</option>
                                <option value="company" selected>Vendedor</option>
                            </select>
                            @endif
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-group-prepend" name="search" placeholder="Ingresa tu búsqueda" value="{{ $search}}">
                        </div>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <div class="input-group">
                        <div class="col-sm-4">
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option disabled selected>Buscar por: </option>
                                <option value="code">Código</option>
                                <option value="title">Títuto</option>
                                <option value="client">Cliente</option>
                                <option value="company">Vendedor</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-group-prepend" name="search" placeholder="Ingresa tu búsqueda">
                        </div>
                    </div>
                </div>
                @endif
                @if($typeDate)
                <div class="form-group">
                    <h5> Filtración por fechas:</h5>
                    <div class="input-group">
                        <div class="col-sm-4">
                            <label>Fecha de: </label>
                            @if($typeDate == 'created_at')
                            <select name="typeDate" class="form-control mr-sm-2" id="typeDate">
                                <option value="created_at" selected>Creación</option>
                                <option value="duedate">Vencimiento</option>
                                <option value="state">Pago</option>
                            </select>
                            @elseif($typeDate == 'duedate')
                            <select name="typeDate" class="form-control mr-sm-2" id="typeDate">
                                <option value="created_at">Creación</option>
                                <option value="duedate" selected>Vencimiento</option>
                                <option value="state">Pago</option>
                            </select>
                            @elseif($typeDate == 'state')
                            <select name="typeDate" class="form-control mr-sm-2" id="typeDate">
                                <option value="created_at">Creación</option>
                                <option value="duedate">Vencimiento</option>
                                <option value="state" selected>Pago</option>
                            </select>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <label> Primera Fecha</label>
                            <input type="date" class="form-control input-group-prepend" name="firstCreationDate" data-date-format="YYYY-MM-DD" value="{{$finalCreationDate}}">
                        </div>
                        <div class="col-sm-4">
                            <label> Última Fecha</label>
                            <input type="date" class="form-control input-group-prepend" name="finalCreationDate" data-date-format="YYYY-MM-DD" value="{{$finalCreationDate}}">
                        </div>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <h5> Filtración por fechas:</h5>
                    <div class="input-group">
                        <div class="col-sm-4">
                            <label>Fecha de: </label>
                            <select name="typeDate" class="form-control mr-sm-2" id="typeDate">
                                <option disabled selected>Selecciona una opción: </option>
                                <option value="created_at">Creación</option>
                                <option value="duedate">Vencimiento</option>
                                <option value="state">Pago</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label> Primera Fecha</label>
                            <input type="date" class="form-control input-group-prepend" name="firstCreationDate" data-date-format="YYYY-MM-DD">
                        </div>
                        <div class="col-sm-4">
                            <label> Última Fecha</label>
                            <input type="date" class="form-control input-group-prepend" name="finalCreationDate" data-date-format="YYYY-MM-DD">
                        </div>
                    </div>
                </div>
                @endif
                @if($state)
                <div class="form-group">
                    <h5> Filtración por estado de factura:</h5>
                    <div class="input-group">
                        <div class="col-sm-12">
                            @if($state == 'paid')
                            <select name="state" class="form-control mr-sm-2" id="state">
                                <option value="paid" selected>Pago</option>
                                <option value="unpaid">No pago</option>
                                <option value="overdue">Vencido</option>
                            </select>
                            @elseif($state == 'unpaid')
                            <select name="state" class="form-control mr-sm-2" id="state">
                                <option value="paid">Pago</option>
                                <option value="unpaid" selected>No pago</option>
                                <option value="overdue">Vencido</option>
                            </select>
                            @elseif($state == 'overdue')
                            <select name="state" class="form-control mr-sm-2" id="state">
                                <option value="paid">Pago</option>
                                <option value="unpaid">No pago</option>
                                <option value="overdue" selected>Vencido</option>
                            </select>
                            @endif

                        </div>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <h5> Filtración por estado de factura:</h5>
                    <div class="input-group">
                        <div class="col-sm-12">
                            <select name="state" class="form-control mr-sm-2" id="state">
                                <option disabled selected>Selecciona una opción: </option>
                                <option value="paid">Pago</option>
                                <option value="unpaid">No pago</option>
                                <option value="overdue">Vencido</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <div>
                    <button type="submit" class="btn btn-primary col-sm-12"> <i class="fas fa-search"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3 ">
            <div class="text-center"><i class="fas fa-users"></i><b> FACTURAS </b></div>
            <div>
                <div>
                    <a class="btn btn-primary btn-circle btn-lg" href="/invoices/create"><i class="fas fa-plus"></i></a>
                    <a class="btn btn-success btn-circle btn-lg" href="{{ route('invoices.import.view') }}"><i class="fas fa-file-import"></i></a>
                    <a class="btn btn-warning btn-circle btn-lg" href="{{ route('invoices.export') }}"><i class="fas fa-file-export"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table col-md-12 table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
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
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->code }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>{{ $invoice->title }}</td>
                            <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                            <td> {{ $invoice->company->name }}</td>
                            <td>
                                @if(isset($invoice->state))
                                <button type="button" class="btn btn-success btn-sm"> Pago </button>
                                @elseif($invoice->duedate <= $now) <button type="button" class="btn btn-danger btn-sm"> Vencido </button>
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm"> Sin pagar </button>
                                    @endif
                            </td>
                            <td>{{ '$'. $invoice->total }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"><i class="far fa-edit"></i> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('invoices.confirm.delete', $invoice->id) }}"><i class="far fa-trash-alt"></i> Eliminar</a>
                                    <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"><i class="far fa-eye"></i> Ver detalles </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $invoices->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection