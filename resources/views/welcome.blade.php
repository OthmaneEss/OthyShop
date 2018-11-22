@extends('layouts.master')

@section('title')
    Home Page
@endsection

@section('content')

    @include('front.layouts.session')
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h5 class="display-3"><strong>Welcome,</strong></h5>
        <p class="display-4"><strong>SALE UP TO 50%</strong></p>
        <p class="display-4">&nbsp;</p>
        <a href="{{url('/user/login')}}" class="btn btn-warning btn-lg float-right">SHOP NOW!</a>
    </header>

@endsection

{{--dd($analytics);--}}