@extends('back-end.layouts.layout-admin')
@section('content')
    <form style="margin-bottom: 50px;" class="form-horizontal" method="post" action="{{route('updateProduct',$product->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h4>Update Product</h4>
        <div class="form-group">
            <div class="col-sm-7 col-md-offset-4">
                <img src="{{ asset('images/front-end/product/'.$product->images) }}" height="140px" width="150px">
            </div>
            <div class="col-md-4">

            </div>
            <input type="file" name="image" id="file" multiple="">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">ID</label>
            <div class="col-sm-7 col-md-8">
                <input type="text" class="form-control" name="id" value="{{$product->id}}" disabled="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Name</label>
            <div class="col-sm-7 col-md-8">
                <input type="text" class="form-control" name="name" value="{{$product->name}}">
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Category</label>
            <div class="col-sm-7 col-md-8">
                <select class="form-control" id="id_type" name="category">
                    <option id="category" value="{{$categoryById->id}}">{{$categoryById->name}}</option>
                    @foreach($categoryAll as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('category'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('category') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Brand</label>
            <div class="col-sm-7 col-md-8">
                <select class="form-control" id="brand" name="brand">
                    <option id="brand" value="{{$brandById->id}}">{{$brandById->name}}</option>
                    @foreach($brandAll as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('brand'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('brand') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Description</label>
            <div class="col-sm-7 col-md-8">
                <input type="text" class="form-control" name="description" value="{{$product->description}}">
            </div>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Unit Price</label>
            <div class="col-sm-7 col-md-8">
                <input type="text" class="form-control" name="unit_price" value="{{$product->unit_price}}">
            </div>
            @if ($errors->has('unit_price'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('unit_price') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Promotion Price</label>
            <div class="col-sm-7 col-md-8">
                <input type="text" class="form-control" name="promotion_price" value="{{$product->promotion_price}}">
            </div>
            @if ($errors->has('promotion_price'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('promotion_price') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-md-2 control-label">Quantity</label>
            <div class="col-sm-7 col-md-8">
                <input type="text" class="form-control" name="quantity" value="{{$product['qty']}}">
            </div>
            @if ($errors->has('quantity'))
                <span class="help-block">
                    <strong style="color: red">{{ $errors->first('quantity') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-4"></div>
        @if(Session::has('message'))
            <p style="color:red">{{Session::get('message')}}</p>
            <div class="col-md-4"></div>
        @endif
        <div>
            <button class="btn btn-default" type="reset">Reset</button>
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
@endsection