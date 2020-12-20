@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta de Mesas</h1>
    </div>

    <v-app>
        <socios-consulta-mesas :unidades="{{ $unidades }}"></socios-consulta-mesas>
    </v-app>

    <!--<div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Todas las mesas</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered display nowrap" id="example" style="width:100%">
                <thead>
                    <th>#</th>
                    <th>Negocio</th>
                    <th>N. mesa</th>
                    <th>N. silla</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Disponible</td>
                        <td>Reservada</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#mesasModal"
                            data-id="" data-num="" data-sillas=""
                            data-estatus="">
                                <i class="far fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>-->
</div>

<div class="modal fade" id="mesasModal" tabindex="-1" aria-labelledby="mesasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('socios_mesas.update','id') }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-row">    
                        <label for="numMesa">Num./Nombre Mesa</label>
                        <input type="text" name="numMesa" id="numMesa" class="form-control">
                        <input type="hidden" name="idMesa" id="idMesa">
                    </div>
                    <div class="form-row">
                        <label for="numPersonas">Numero de Sillas/Personas</label>
                        <input type="number" name="numPersonas" id="numPersonas" class="form-control" min="1" max="20" step="1">
                    </div>
                    <div class="form-row">
                        <label for="estatusMesa">Estatus Mesa</label>
                        <select name="estatusMesa" id="estatusMesa" class="form-control">
                            <option value="1">Reservada/No Disponible</option>
                            <option value="0">Disponible</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('DataTables/dataTables.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('DataTables/dataTables.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );
} );
</script>
<script src="{{ asset('js/datos.js') }}"></script>
@endpush