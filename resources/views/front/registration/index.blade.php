@extends('front.layouts.master')

@section('title')
    Register Page
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12" id="register">

            <div class="card col-md-8">
                <div class="card-body">
                    <h2 class="card-title">Sign Up</h2>
                    <hr>

                        @include('front.layouts.message')

                    <form action="/user/register" method="post" >

                                @csrf

                        <div class="form-group">
                            <label for="email">Name:</label>
                            <input type="text" name="name" placeholder="Name" id="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" placeholder="Email" id="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="text" name="password" placeholder="Password" id="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Password Confirmation:</label>
                            <input type="text" name="password_confirmation" placeholder="Password Confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea  name="address" placeholder="Address" id="address" class="form-control" ></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-info col-md-2"> Sign Up</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

@endsection