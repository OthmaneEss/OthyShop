<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{Form::label('User Name', 'User Name')}}

    {{Form::text('name',$user->name,['class'=>'form-control border-input','placeholder'=>'Product Name']) }}
    <span class="text-danger">{{$errors->has('name')? $errors->first('name') : ''}}</span>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{Form::label('Email :', 'Email')}}
    {{Form::text('email',$user->email,['class'=>'form-control border-input','placeholder'=>'Email']) }}
    <span class="text-danger">{{$errors->has('email')? $errors->first('email') : ''}}</span>
</div>

