@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3 ">
            <div class="text-center"><i class="fas fa-users"></i><b> FACTURAS </b></div>
            <div>
                <div>
                    <a class="btn btn-primary btn-circle btn-lg" href="/invoices/create"><i class="fas fa-plus"></i></a>
                    <a class="btn btn-success btn-circle btn-lg" href="{{ route('invoices.import.view') }}"><i class="fas fa-file-import"></i></a>
                    <a class="btn btn-warning btn-circle btn-lg" href="{{ route('export') }}"><i class="fas fa-file-export"></i></a>
                </div>
                <div>
                    <form action="{{ route('invoices.index') }}" method="GET" class="form-inline justify-content-end">
                        @if (empty($_GET))
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div>
                                    <select name="type" class="form-control mr-sm-2" id="type">
                                        <option disabled selected>Buscar por:</option>
                                        <option value="code">Código</option>
                                        <option value="title">Títuto</option>
                                        <option value="client">Cliente</option>
                                        <option value="company">Vendedor</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control input-group-prepend" name="search" placeholder="Ingresa tu búsqueda" required>
                                <div>
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('invoices.index') }}" class="btn btn-circle btn-danger"><i class="fas fa-undo"></i> </button></a>
                        @endif
                    </form>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    FILTRAR POR:
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <div class="dropdown-item">
                            <h5> Por rango de fechas:</h5>
                            <form class="px-4 py-3" action="{{ route('invoices.index') }}" method="GET">
                                <div class="form-group"> 
                                    <div class="input-group">
                                        <div>
                                            <label>Fecha de: </label>
                                            <select name="typeDate" class="form-control mr-sm-2" id="typeDate">
                                                <option disabled selected>Seleccione una opción:</option>
                                                <option value="created_at">Creación</option>
                                                <option value="duedate">Vencimiento</option>
                                                <option value="state">Pago</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label> Primera Fecha</label>
                                            <input type="date" class="form-control input-group-prepend" name="firstCreationDate" data-date-format="YYYY-MM-DD" required>
                                        </div>
                                        <div>
                                            <label> Última Fecha</label>
                                            <input type="date" class="form-control input-group-prepend" name="finalCreationDate" data-date-format="YYYY-MM-DD" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">FILTRAR</button>
                            </form>
                        </div>
                        <div class="dropdown-item">
                        <h5> Por estado de Factura:</h5>
                            <form class="px-4 py-3" action="{{ route('invoices.index') }}" method="GET">
                                <div class="form-group">
                                    <div>
                                        <select name="state" class="form-control mr-sm-2" id="state">
                                            <option disabled selected>Seleccione una opción:</option>
                                            <option value="paid">Pago</option>
                                            <option value="unpaid">No pago</option>
                                            <option value="overdue">Vencido</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">FILTRAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
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
                {{ $invoices->render() }}
            </div>
        </div>
    </div>
</div>
@endsection