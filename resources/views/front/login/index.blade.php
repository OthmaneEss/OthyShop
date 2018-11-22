@extends('front.layouts.master')

@section('title')

    Se connecter

@endsection

@section('content')

    <div class="row">

        <div class="col-md-12" id="register">

            <div class="card col-md-8">
                <div class="card-body">

                    <h2 class="card-title">Login</h2>
                    <hr>

                  @include('front.layouts.message')

                   @include('front.layouts.session')

                    <form action="{{url('/user/login')}}" method="post">

                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" placeholder="Email" id="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" placeholder="Password" id="password"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-info col-md-2"> Login</button>
                            <a href="{{url('/user/register')}}" class="btn btn-success col-md-2"> Register</a>
                        </div>


                    </form>

                </div>
            </div>


        </div>

    </div>

@endsection