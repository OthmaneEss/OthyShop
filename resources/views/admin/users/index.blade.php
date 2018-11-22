@extends('admin.layouts.master')

@section('page')
    List of Users
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registred at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($users as $user)
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>

                            <td>
                                <button class="btn btn-sm btn-success ti-close" title="Block User"></button>

                                {{link_to_route('users.show','',$user->id,['class'=>'btn btn-primary btn-sm ti-list'])}}

                            </td>
                        </tr>
                        @endforeach

                        <center>{{$users->links()}}</center>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection