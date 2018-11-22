@extends('admin.layouts.master')

@section('page')

    Edit a Product
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">
            <div class="card">


                {{--@if ($errors->any())--}}

                {{--<ul>--}}
                {{--@foreach ( $errors->all() as $error )--}}


                {{--<li>{{ $error }}</li>--}}

                {{--@endforeach--}}
                {{--</ul>--}}
                {{--@endif--}}

                @if (session()->has('msg'))

                    <div class="alert alert-success">{{ session()->get('msg') }}</div>

                @endif

                <div class="content">
                    {!! Form::open(array('url' => ['admin/products',$product->id],'files'=>'true','method'=>'put')) !!}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.products._fields')
                        </div>

                    </div>

                </div>
                <div class="">
                    {{Form::submit('Edit Product',['class'=>'btn btn-primary'])}}

                </div>
                <div class="clearfix"></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@endsection