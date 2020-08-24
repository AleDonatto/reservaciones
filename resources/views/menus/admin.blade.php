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
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSocios" aria-expanded="true" aria-controls="collapseSocios">
        <i class="fas  fa-fw fa-users"></i>
        <span>Socios</span>
    </a>
    <div id="collapseSocios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="{{ route('socios.create') }}">Registrar Socios </a>
            <a class="collapse-item" href="{{ route('socios.index') }}">{{ __('Consulta de Socios') }}</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-store-alt"></i>
        <span>Unidades de Negocio</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="{{ route('negocios.create') }}">Agregar Nueva Unidad</a>
            <a class="collapse-item" href="{{ route('negocios.index') }}">Consulta de Unidades </a>
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
            <a href="{{ route('mesas.create') }}" class="collapse-item">Agregar Mesas</a>
            <a href="{{ route('mesas.index') }}" class="collapse-item">Consulta Mesas</a>
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
            <a href="" class="collapse-item">Consulta de Reservaciones</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-qrcode"></i>
        <span>Codigos de Seguridad</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="{{ route('codigos.create') }}">Nuevo Codigo</a>
            <a class="collapse-item" href="">Consulta de codigos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
        <i class="fas fa-user-plus"></i>
        <span>Usuarios</span>
    </a>
    <div class="collapse" id="collapseUser" aria-labelledby="headingUser" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom User</h6>
            <a href="" class="collapse-item">Nuevo Usuario</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider"> 

<!-- Heading -->
<div class="sidebar-heading">
    Extras
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="far fa-fw fa-folder-open"></i>
        <span>Paginas</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a href="http://" target="_blank" rel="noopener noreferrer" class="collapse-item">Login</a>
            <a href="http://" target="_blank" rel="noopener noreferrer" class="collapse-item">Registro</a>
            <a href="http://" target="_blank" rel="noopener noreferrer" class="collapse-item">Recuperar Contraseña</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle">
    </button>
</div>