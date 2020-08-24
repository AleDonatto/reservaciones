@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weith-bold text-primary">Consulta de Unidades de Negocios</h4>
        </div>
        <div class="card-body">
            <table id="usertable" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>id Compañia</th>
                        <th>RFC</th>
                        <th>Nombre Unidad</th>
                        <th>Telefono 1</th>
                        <th>Telefono 2</th>
                        <th>Correo </th>
                        <th>Sitio Web</th>
                        <th>Nombre Contacto</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $item)
                    <tr>
                        <td>{{ $item->idUnits }}</td>
                        <td>{{ $item->idcompany }}</td>
                        <td>{{ $item->RFC }}</td>
                        <td> <a href="{{ route('mesas.show',$item->idUnits ) }}">{{ $item->nameUnit }}</a> </td>
                        <td>{{ $item->phone1 }}</td>
                        <td>{{ $item->phone1 }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->webSite }}</td>
                        <td>{{ $item->nameContact }}</td>
                        <td>
                            <button type="button" class="btn btn-circle btn-info">
                                <i class="far fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-circle btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container text-center my-3">
    <h2 class="font-weight-light">Bootstrap 4 - Multi Item Carousel</h2>
    <div class="row mx-auto my-auto">
        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">
                <div class="carousel-item active">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <img class="img-fluid" src="http://placehold.it/380?text=1">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <img class="img-fluid" src="http://placehold.it/380?text=2">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <img class="img-fluid" src="http://placehold.it/380?text=3">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <img class="img-fluid" src="http://placehold.it/380?text=4">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <img class="img-fluid" src="http://placehold.it/380?text=5">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <img class="img-fluid" src="http://placehold.it/380?text=6">
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <h5 class="mt-2">Advances one slide at a time</h5>
</div>
@endsection

@push('styles')
<!--<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">-->
<link rel="stylesheet" href="{{ asset('DataTables/DataTables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('DataTables/Buttons/css/buttons.bootstrap4.min.css') }}">
<style>
    @media (max-width: 768px) {
    .carousel-inner .carousel-item > div {
        display: none;
    }
    .carousel-inner .carousel-item > div:first-child {
        display: block;
    }
}

.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
    display: flex;
}

/* display 3 */
@media (min-width: 768px) {
    
    .carousel-inner .carousel-item-right.active,
    .carousel-inner .carousel-item-next {
      transform: translateX(33.333%);
    }
    
    .carousel-inner .carousel-item-left.active, 
    .carousel-inner .carousel-item-prev {
      transform: translateX(-33.333%);
    }
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left{ 
  transform: translateX(0);
}

</style>
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
<script>
$('#recipeCarousel').carousel({
  interval: 10000
})

$('.carousel .carousel-item').each(function(){
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
    next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
    
    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
        	next = $(this).siblings(':first');
      	}
        
        next.children(':first-child').clone().appendTo($(this));
      }
});
</script>
@endpush