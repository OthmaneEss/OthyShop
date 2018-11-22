<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{Form::label('Product Name', 'Product Name')}}

    {{Form::text('name',$product->name,['class'=>'form-control border-input','placeholder'=>'Product Name']) }}
    <span class="text-danger">{{$errors->has('name')? $errors->first('name') : ''}}</span>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    {{Form::label('Product Price :', 'Product Price')}}
    {{Form::text('price',$product->price,['class'=>'form-control border-input','placeholder'=>'Product Price']) }}
    <span class="text-danger">{{$errors->has('price')? $errors->first('price') : ''}}</span>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{Form::label('Product Description :', 'Product Description')}}
    {{Form::textarea('description',$product->description,['class'=>'form-control border-input','placeholder'=>'Product Description','cols'=>'30','rows'=>'10']) }}
    <span class="text-danger">{{$errors->has('description')? $errors->first('description') : ''}}</span>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
{{Form::label('Product Image :', 'Product Image')}}
{{Form::file('image',['class'=>'form-control border-input','placeholder'=>'Product Image','id'=>'image']) }}
    <div id="card"> <div id="thumb-output"></div></div>

    <span class="text-danger">{{$errors->has('image')? $errors->first('image') : ''}}</span>