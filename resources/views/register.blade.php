<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/sb-2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" 
    rel="stylesheet">

</head>
<body>

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image" style=" background-image: url('images/res.jpg');"></div>
                    <div class="col-lg-7">
                        <div class="p-3">
                            <div class="text-center mt-3">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form class="user" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user @error('FirstName') is-invalid @enderror" name="FirstName" 
                                            id="FirstName" placeholder="First Name">

                                            @error('FirstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user @error('LastName') is-invalid @enderror" name="LastName" 
                                            id="LastName" placeholder="Last Name">

                                            @error('LastName')
                                            <span class="invalid-feddback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('InputEmail') is-invalid @enderror" name="InputEmail" 
                                        id="InputEmail" placeholder="Email Address">

                                        @error('InputEmail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user @error('InputPassword') is-invalid @enderror" name="InputPassword" 
                                            id="InputPassword" placeholder="Password">

                                            @error('InputPassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user @error('RepeatPassword') is-invalid @enderror" name="RepeatPassword" 
                                            id="RepeatPassword" placeholder="Repeat Password">

                                            @error('RepeatPassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                    <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-2x fa-fw"></i> 
                                        <span>Register width Google</span>
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook fa-2x fa-fw"></i> 
                                        <span>Register width Facebook</span>
                                    </a>
                                </form>
                            </div>
                            
                            <hr>
                            <div class="text-center">
                                <a class="small" href="">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ url('/app_login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-2.min.js') }}"></script>
</body>
</html>