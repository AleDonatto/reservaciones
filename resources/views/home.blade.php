@extends('layouts.app')

@section('content')
<div class="container">

    @if(Auth::user()->rol == 4)
        @include('components.clientes.homereservar')
    @endif

    
    <!--<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>-->

</div>
@endsection
