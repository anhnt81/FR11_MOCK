@extends('back-end.layouts.layout-admin')
@section('title')
    Quản lý sản phẩm
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/product') !!}">Sản phẩm</a></li>
    <li>Cập nhật thông tin</li>
@endsection
@section('content')
    <h2>Update Product</h2>
    <form style="margin-bottom: 50px;" class="form-horizontal" method="post"
          action="{{route('updateProduct',$product->id)}}" enctype="multipart/form-data">
        <div class='col-xs-12 col-md-3' id='upImg'>
            <div class='form-group'>
                @if ($errors->has('image[]'))
                    <span class="help-block">
                    <strong style="color: red">{{ $errors->first('image[]') }}</strong>
                </span>
                @endif

                <button class='btn btn-primary' id='add-img' type='button'>Thêm ảnh</button>
            </div>
        </div>

        <div class='col-xs-12 col-md-9'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div style='padding : 0 20px'>
                    @foreach($images as $item)
                        <div style='float:left;'>
                            <img src="{{ asset('images/front-end/product/'.$item) }}" class='img-prd'>
                            <button type='button' class='close del-img-prd' pid='{{$product->id}}' image='{{$item}}'>&times;</button>
                        </div>
                    @endforeach
                </div>
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
                <textarea class="form-control" name="description" id="description" rows="5"
                          cols="20">{{$product->description}}</textarea>
                    <script>
                        var editor2 = CKEDITOR.replace("description");
                        CKFinder.setupCKEditor(editor2);
                    </script>
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
            <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label">Action</label>
                <div class="col-sm-7 col-md-8">
                    <select class="form-control" id="new" name="new">
                        <option id="new" value="{{$product['new']}}">
                            @if($product['new'] == 1)
                                New Product
                            @else
                                Old Product
                            @endif
                        </option>
                        @if($product['new'] == 1)
                            <option value="0">Old Product</option>
                        @else
                            <option value="1">New Product</option>
                        @endif
                    </select>
                </div>
                @if ($errors->has('new'))
                    <span class="help-block">
                    <strong style="color: red">{{ $errors->first('new') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label">Status</label>
                <div class="col-sm-7 col-md-8">
                    <select class="form-control" id="status" name="status">
                        <option id="status" value="{{$product['status']}}">
                            @if($product['status'] == 1)
                                Active
                            @else
                                Not Active
                            @endif
                        </option>
                        @if($product['status'] == 1)
                            <option value="0">Not Active</option>
                        @else
                            <option value="1">Active</option>
                        @endif
                    </select>
                </div>
                @if ($errors->has('status'))
                    <span class="help-block">
                    <strong style="color: red">{{ $errors->first('status') }}</strong>
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
        </div>
    </form>


    <script>
        $(document).ready(function () {
            var i = 0;
            $('#add-img').click(function () {
                i++;
                $(this).before(
                    "<div><img class='img-prd' id='img"+i+"'>"+
                    "<input type='file' class='input-add-img' name='image[]' onchange='previewImage(this, \"img"+i+"\")'>" +
                    "<button type='button' class='close del-up-img'>&times;</button></div>"
                );
                $(".del-up-img").click(function () {
                    console.log($(this).parent());
                     $(this).parent().remove();
                });
            });

            $('.del-img-prd').click(function () {
                var pid = $(this).attr('pid');
                var image = $(this).attr('image');
                var div = $(this).parent();

                $.ajax({
                    url:'/admin/product/del-img',
                    data:{
                        pid:pid,
                        image:image
                    },
                    success: function (responce) {
                        if(responce == 'ok') {
                            $(div).remove();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                })
            });
        })
    </script>
@endsection