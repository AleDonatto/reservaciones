<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sb-2.min.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">-->
    <link href="//fonts.googleapis.com/css?family=Pacifico&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .sidebar-brand-text > h4{
            text-decoration: none;
            font-family: 'Pacifico',cursive;
            font-size: 2rem;
        }
    </style>
    @stack('styles')
</head>
<body id="page-top">
    <div id="app">
        <div id="wrapper">

            <!--@Auth-->
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        <h4><span>QT</span></h4> 
                    </div>
                </a>
                
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                @if(Auth::user()->rol == 1 )
                    @include('menus.admin')
                @elseif( Auth::user()->rol == 2)
                    @include('menus.socio')
                @elseif( Auth::user()->rol == 3)
                    @include('menus.cliente')
                @endif
            </ul>
            <!-- End of Sidebar -->
            <!--@endauth-->

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('app_login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('app_register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{  route('profileUser') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <!--<a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Configuracion
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Registro de Actividades
                                    </a>-->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Logout') }}
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </nav>

                    @Auth
                    <div class="container-fluid">
                        @if(session('mensaje'))
                        <div class="alert alert-success alert-dismissible fade show my-5" role="alert">
                            <strong>{{ Session::get('title') }}!</strong> <br> {{ Session::get('mensaje') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        
                        <main class="">
                            @yield('content')
                        </main>
                    </div>
                    @endauth

                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; QuickTable @php $year = date('Y'); print($year); @endphp</span>
                        </div>
                    </div>
                </footer>
            </div>    
        </div>
    </div>

    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    @if(session('messageDB'))
    <script type="text/javascript">
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.options.closeButton = true;
                    toastr.options.escapeHtml = true;
                    toastr.options.progressBar = true;
                    toastr.info("{{ Session::get('messageDB') }}","{{ Session::get('messageHeader') }}",{timeOut :  15000});
                    break;
    
                case 'warning':
                    toastr.options.closeButton = true;
                    toastr.options.escapeHtml = true;
                    toastr.options.progressBar = true;
                    toastr.warning("{{ Session::get('messageDB') }}","{{ Session::get('messageHeader') }}",{timeOut :  15000});
                    break;
    
                case 'success':
                    toastr.options.closeButton = true;
                    toastr.options.escapeHtml = true;
                    toastr.options.progressBar = true;  
                    toastr.success("{{ Session::get('messageDB') }}","{{ Session::get('messageHeader') }}",{timeOut :  15000});
                    break;
    
                case 'error':
                    toastr.options.closeButton = true;
                    toastr.options.escapeHtml = true;
                    toastr.options.progressBar = true;
                    toastr.error("{{ Session::get('messageDB') }}","{{ Session::get('messageHeader') }}",{timeOut :  15000});
                    break;
            }
    </script>
    @endif
    <!--<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-2.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
