@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weith-bold text-primary">Consulta de Socios</h6>
        </div>
        <div class="card-body">
            <table id="usertable" class="table table-striped display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>RFC</th>
                        <th>Razon Social</th>
                        <th>Telefono 1</th>
                        <th>Telefono 2</th>
                        <th>Correo</th>
                        <th>Sitio Web</th>
                        <th>Nombre Contacto</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socios as $item)
                    <tr>
                        <td>{{ $item->idCompanies }}</td>
                        <td>{{ $item->RFC }}</td>
                        <td> <a href="{{ route('negocios.show',$item->idCompanies) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->phone1 }}</td>
                        <td>{{ $item->phone2 }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->website }}</td>
                        <td>{{ $item->name_contact }}</td>
                        <td>
                            <button type="button" class="btn btn-circle btn-info">
                                <i class="far fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-circle btn-sm btn-info">Opcion</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>RFC</th>
                        <th>Razon Social</th>
                        <th>Telefono 1</th>
                        <th>Telefono 2</th>
                        <th>Correo</th>
                        <th>Sitio Web</th>
                        <th>Nombre Contacto</th>
                        <th>Opciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!--<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">-->
<link rel="stylesheet" href="{{ asset('DataTables/DataTables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('DataTables/Buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<!--<script src="{{ asset('DataTables/dataTables.min.js') }}"></script>-->
<script src="{{ asset('DataTables/DataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('DataTables/jszip.min.js') }}"></script>
<script src="{{ asset('DataTables/pdfmake.min.js') }}"></script>
<script src="{{ asset('DataTables/vfs_fonts.js') }}"></script>

<script src="{{ asset('DataTables/Buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons/js/buttons.colVis.min.js') }}"></script>


<script>

    var table = $('#usertable').DataTable( {
        "dom": 'Blfrtip',
        "scrollX": true,
        lengthChange: false,
        //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
        buttons: ['copy', 'excel', 'colvis']
    } );
    
    table.buttons().container()
        .appendTo( '#usertable_wrapper .col-md-6:eq(0)' );
    
    //table.buttons().container().appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
  
    //table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

</script>
@endpush