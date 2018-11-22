<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>OthyShop Admin</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    {{Html::style('assets/css/bootstrap.min.css')}}

    {{Html::style('assets/css/animate.min.css')}}

    {{Html::style('assets/css/paper-dashboard.css')}}

    {{Html::style('assets/fontawesome/css/all.css')}}

    {{--{{Html::style('assets/css/fontawesome.min.css')}}--}}

    {{Html::style('assets/css/fonts.css')}}

    {{Html::style('assets/css/themify-icons.css')}}

    {{Html::style('assets/css/thumbnail.css')}}



</head>
<body>

<div class="wrapper">
@include('admin.layouts.sidebar')

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">@yield('page')</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-user"></i>
                                <p>{{auth()->guard('admin')->check() ? auth()->guard()->user()->name : 'Account'}}</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Profil</a></li>
                               <li><a href="/admin/logout"><i class="fa fa-sign-out-alt"></i>Logout</a> </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <img width="32" height="32" alt="{{ session('locale') }}"
                                     src="{!! asset('images/flags/' . session('locale') . '-flag.png') !!}"/>
                                {{ session('locale') }}

                            </a>
                            <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
                                @foreach(config('app.locales') as $locale)
                                    @if($locale != session('locale'))
                                        <a class="dropdown-item" href="{{ route('language', $locale) }}">
                                            <img width="32" height="32" alt="{{ session('locale') }}"
                                                 src="{!! asset('images/flags/' . $locale . '-flag.png') !!}"/>
                                            {{$locale}}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
               @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="">
                                Contact
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Licenses
                            </a>
                        </li>



                    </ul>


                </nav>
                <div class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    , made with <i class="fas fa-heart heart"></i> by <a href="">Othmane Ess</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>
{{Html::script('assets/js/fontawesome.js')}}
{{Html::script('assets/js/fontawesome.min.js')}}
{{Html::script('assets/js/jquery-1.10.2.js')}}
{{Html::script('assets/js/bootstrap.min.js')}}
{{Html::script('assets/js/thumbnail.js')}}
{{Html::script('assets/js/zoom.js')}}


</html>
