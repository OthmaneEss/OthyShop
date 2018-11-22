@extends('admin.layouts.master')
@section('page')
    List of products
@endsection

@section('content')

    @if (session()->has('msg'))

        <div class="alert alert-success">{{ session()->get('msg') }}</div>

    @endif
    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}} DH</td>
                            <td>{{$product->description}}</td>
                            <td><img id="image" src="{{url('./uploads').'/'.$product->image}}" alt="{{$product->image}}" class="img-thumbnail"
                                     style="width: 50px"></td>
                            <td>

                                {{Form::open(['route'=>['products.destroy',$product->id],'method'=>'DELETE'])}}
                                {{csrf_field()}}
                                {{--{{method_field('delete')}}--}}
                                {{Form::button('<span class="fa fa-trash"></span>',['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'confirm("Are you sure you want to delete this item?")' ])}}

                                {{link_to_route('products.edit','',$product->id,['class'=>'btn btn-info btn-sm ti-pencil'])}}
                                {{link_to_route('products.show','',$product->id,['class'=>'btn btn-primary btn-sm ti-list'])}}

                                {{Form::close()}}

                            </td>
                        </tr>
                       @endforeach

                        </tbody>
                        <center>{{$products->links()}}</center>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @endsection