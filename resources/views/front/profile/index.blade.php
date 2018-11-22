@extends('front.layouts.master')

@section('title')
    User Profil
@endsection

@section('content')

    @include('front.layouts.session')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th colspan="2">User Details
               <a class="pull-right"> {{link_to_route('userProfile.edit','Edit',$user->id,['class'=>'btn btn-info btn-sm ti-pencil'])}}
                </a>
            </th>
        </tr>
        </thead>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $user->name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Registered At</th>
            <td>{{ $user->created_at->diffForHumans()}}</td>
        </tr>

        <tr>
            <th>Updated At</th>
            <td>{{ $user->updated_at->diffForHumans()}} </td>
        </tr>
    </table>

    <div class="card">


        <div class="content table-responsive table-full-width">
            <table class="table table-hover">
                <thead>

                <tr>
                    <th> <h4>User Orders<h4>

                    </th>
                </tr>

                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach ($user->orders as $order)
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            @foreach ($order->products as $item)
                                <table class="table">
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>

                        <td>
                            @foreach ($order->orderItems as $item)
                                <table class="table">
                                    <tr>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>

                        <td>
                            @if ($order->status)
                                <span class="label label-success">Confirmed</span>
                            @else
                                <span class="label label-warning">Pending</span>
                            @endif
                        </td>

                        <td>

                            {{--<button class="btn btn-sm btn-success ti-check"--}}
                            {{--title="Confirm Order"></button>--}}

                            <a href="{{url('/userProfile').'/'.$order->id}}" class="btn btn-outline-dark btn-xs "
                            title="Details" > Details</a>


                        </td>
                </tr>
                @endforeach



                </tbody>
            </table>

        </div>
    </div>

 @endsection