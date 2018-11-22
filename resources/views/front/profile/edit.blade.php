@extends('front.layouts.master')

@section('title')
    Edit User
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">

            <center><h4>Edit User Informations</h4></center>

                @if (session()->has('msg'))

                    <div class="alert alert-success">{{ session()->get('msg') }}</div>

                @endif

                <br>
                <div class="content">
                    {!! Form::open(array('url' => ['/userProfile',$user->id],'method'=>'put')) !!}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">

                            @include('front.profile._fields')
                        </div>

                    </div>

                </div>
                <div class="">
                    {{Form::submit('Edit User',['class'=>'btn btn-primary'])}}
                    <a href="{{ url('/userProfile') }}" class="btn btn-success">Back to User Profil</a>


                </div>
                <div class="clearfix"></div>
                {!! Form::close() !!}

        </div>
    </div>

@endsection
