<!-- Nav Item - Dashboard -->
<li class="nav-item active">
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
<li class="nav-item">
    <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseBooking" aria-expanded="true" aria-controls="collapseBooking">
        <i class="far fa-fw fa-address-book"></i>
        <span>Reservaciones</span>
    </a>
    <div id="collapseBooking" class="collapse" aria-labelledby="headingBookig" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a href="{{ route('clientes_reservacion') }}" class="collapse-item">Hacer Reservacion</a>
            <a href="{{ route('allReservasClients') }}" class="collapse-item">Consultar Reservaciones</a>
        </div>
    </div>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle">
    </button>
</div>