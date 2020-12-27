<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-store-alt"></i>
        <span>Unidades de Negocio</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="{{ route('viewUnidadUser') }}">Consulta de Unidad </a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTables" aria-expanded="true" aria-controls="collpaseTables">
        <i class="fas fa-fw fa-chair"></i>
        <span>Mesas</span>
    </a>
    <div class="collapse" id="collapseTables" aria-labelledby="headingTables" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a href="{{ route('viewFormMesasUserUnits') }}" class="collapse-item">Agregar Mesas</a>
            <a href="{{ route('viewConsMesasUserUnits') }}" class="collapse-item">Consulta Mesas</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseBooking" aria-expanded="true" aria-controls="collapseBooking">
        <i class="far fa-fw fa-address-book"></i>
        <span>Reservaciones</span>
    </a>
    <div id="collapseBooking" class="collapse" aria-labelledby="headingBookig" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a href="{{ route('viewFormReservacionesUserUnits') }}" class="collapse-item">Reservar Mesa</a>
            <a href="{{ route('viewConsReservacionesUserUnit') }}" class="collapse-item">Consulta Reservaciones</a>
            <a href="{{ route('getUsersReservaciones') }}" class="collapse-item">Mis Reservaciones</a> 
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider"> 

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle">
    </button>
</div>