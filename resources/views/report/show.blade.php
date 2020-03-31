@if(Auth::user()->notifications)

@endif
@extends ('layouts.app')
@section('content')
<div class="container" style="max-width: 1200px">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3 ">
            <div class="text-center"><i class="fas fa-file-export"></i><b> REPORTES GENERADOS </b></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table col-md-12 table-hover table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" scope="col">Creación</th>
                            <th rowspan="2" scope="col">Tipo de archivo</th>
                            <th colspan="2" scope="col">Filtros</th>
                            <th rowspan="2" scope="col">Acción</th>
                        <tr>
                            <th scope="col">Rango de fecha de creación</th>
                            <th scope="col">Estado de las facturas</th>
                        </tr>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>

                            <td>{{ $report->created_at }}</td>
                            <td>{{ $report->data['type'] }}</td>
                            <td>{{ $report->data['firstCreationDate'] . '-' . $report->data['finalCreationDate'] }}</td>
                            <td>{{ $report->data['state'] }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('report.delete', $report->id) }}" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i> Eliminar
                                    </a>
                                    <a class="btn btn-success" href="{{ $report->data['link'] }}"><i class="fas fa-download"></i> Descargar</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center"> NO SE ENCUENTRAN REPORTES </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection