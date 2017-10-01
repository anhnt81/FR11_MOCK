@extends('back-end.layouts.master')
@section('content')
    <div class="col-md-3">
        <form enctype="multipart/form-data" action="" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-default" style="margin-top:15px"><i  class="fa fa-plus"></i>Thêm Sản Phẩm</a>
            <div class="modal fade" tabindex="-1" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Product</h4>
                        </div>
                        <div class="modal-body">
                            <p>Image<input type="file" name="image" id="file" multiple=""></p>
                            <p>Name<input type="text" name="name" id="name" class="form-control"></p>
                            <p>Type
                                <select class="form-control" selected="" id="type" name="type">
                                    <option id="type">Select</option>
                                    {{--@foreach($type as $t)--}}
                                        {{--<option id="type" value="{{ $t->id }}">{{ $t->name }}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </p>
                            <p>Description<input type="text" name="description" id="description" class="form-control"></p>
                            <p>Unit Price<input type="text" name="unit_price" id="unit_price" class="form-control"></p>
                            <p>Promotion Price<input type="text" name="promotion_price" id="promotion_price" class="form-control"></p>
                            <p>Unit<input type="text" name="unit" id="unit" class="form-control"></p>
                            <p>New<select class="form-control" selected="" id="new" name="new"><option>Select</option><option>0</option><option>1</option></select></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="display: none">Close</button>
                            <button type="button" class="btn btn-primary" style="display: none">Save changes</button>
                            <button type="submit" class="btn btn-primary" id="addButton">Add</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$('#addButton').submit(function(event){--}}
                {{--var name = $('#name').val();--}}
                {{--var image = $('#file').val();--}}
                {{--var type = $('#type').val();--}}
                {{--var description = $('#description').val();--}}
                {{--var unit_price = $('#unit_price').val();--}}
                {{--var promotion_price = $('#promotion_price').val();--}}
                {{--var unit = $('#unit').val();--}}
                {{--var neww = $('#new').val();--}}
                {{--$.post(--}}
                    {{--'list.product',{'image' : image,'name' : name, 'type' : type,'description' : description , 'unit_price': unit_price, 'promotion_price' : promotion_price, 'unit' : unit, 'new' : neww , '_token':$('input[name=_token]').val()},function(data){--}}
                        {{--console.log(data);--}}
                    {{--}--}}
                {{--);--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
    <div class="col-md-5"></div>
    <form class="navbar-form navbar-left" role="search" method="get" id="searchform" action="">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="keyword" id="keyword">
        </div>
        <button type="submit" class="btn btn-default" style="margin-top:5px">Tìm Kiếm</button>
    </form>
    <table class="table table-bordered">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th>ID_Type</th>
        <th>Description</th>
        <th>Unit_Price</th>
        <th>Promotion_Price</th>
        <th>Unit</th>
        <th>New</th>
        <th>Image</th>
        <th>Action</th>
        </thead>
        <tbody>
        {{--@foreach($products as $product)--}}
            {{--<tr>--}}
                {{--<td>{{$product->id}}</td>--}}
                {{--<td>{{$product->name}}</td>--}}
                {{--<td>{{$product->id_type}}</td>--}}
                {{--<td>{{$product->description}}</td>--}}
                {{--<td>{{$product->unit_price}}</td>--}}
                {{--<td>{{$product->promotion_price}}</td>--}}
                {{--<td>{{$product->unit}}</td>--}}
                {{--<td>{{$product->new}}</td>--}}
                {{--<td><img src="{{asset($product->image)}}" height="50px" width="50px"></td>--}}
                {{--<td><a href="{{route('edit.product',$product->id)}}">Sửa</a>&nbsp;&nbsp;<a href="{{route('delete.product',$product->id)}}">Xóa</a></td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        </tbody>
    </table>
    @if(Session::has('message'))
        <p style="color:red">{{Session::get('message')}}</p>
    @endif

    <div class="col-md-3"></div>
    {{--<div class="row">{{$products->links()}}</div>--}}
@endsection
