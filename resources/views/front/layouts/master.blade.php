<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    {{--<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">--}}
    <link href="{{url('assets/fontawesome/css/all.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{url('assets/css/heroic-features.css')}}" rel="stylesheet">
    {{--<link href="{{url('assets/css/fonts.css')}}" rel="stylesheet">--}}
    <link href="{{url('assets/css/themify-icons.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('style')
</head>

<body>

{{--@include('front.layouts.nav')--}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">

        <a class="navbar-brand" href="{{url('/home')}}">  <img src="{{url('images/logo.png')}}" height="30px" width="30px">  OthyShop</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Panier

                        @if(Cart::instance('default')->count()>0)
                            <strong>({{Cart::instance('default')->count()}})</strong>
                        @endif

                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> {{auth()->check() ? auth()->user()->name : 'Account'}}
                    </a>

                    @if(!auth()->check())
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                            <a class="dropdown-item " href="{{url('/user/login')}}">Se connecter</a>
                            <a class="dropdown-item" href="{{url('/user/register')}}">S'inscrire</a>

                        </div>

                    @else
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                            <a class="dropdown-item " href="{{url('/userProfile')}}">Profil</a>
                            <a class="dropdown-item" href="{{url('/user/logout')}}">Se deconnecter</a>

                        </div>

                    @endif

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img width="32" height="32" alt="{{ session('locale') }}"
                             src="{!! asset('images/flags/' . session('locale') . '.png') !!}"/>
                    </a>
                    <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
                        @foreach(config('app.locales') as $locale)
                            @if($locale != session('locale'))
                                <a class="dropdown-item" href="{{ route('language', $locale) }}">
                                    <img width="32" height="32" alt="{{ session('locale') }}"
                                         src="{!! asset('images/flags/' . $locale . '-flag.png') !!}"/>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>


<!-- Page Content -->
<div class="container">



    @yield('content')
    <!-- Page Features -->

    <!-- /.row -->

</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<script src="{{url('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/fontawesome/js/fontawesome.min.js')}}"></script>
<script src="{{url('assets/fontawesome/js/fontawesome.js')}}"></script>

@yield('script')
</body>

</html>
