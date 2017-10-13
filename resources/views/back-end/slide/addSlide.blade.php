@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý Slide
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{{ url('admin/slide') }}"> Danh sách slide</a></li>
    <li>Thêm Slide</li>
@endsection

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm Slide</h3>
    </div>  
    @if(session('slide'))
        <div class="alert alert-success fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <b>{{session('slide')}}</b><br>         
        </div>
    @endif
    <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Thể loại</label>
                <select class="form-control" id="theloai">
                    @foreach($theloai as $tl)
                        <option value="{{$tl->id}}">{{$tl->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="table-responsive" id="product1">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Mô Tả</th>
                        <th>Thêm Làm Slide</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($list) < 1)
                        <tr>
                            <td colspan="5">Chưa có dữ liệu</td>
                        </tr>
                    @else
                        @foreach($list as $row)
                            <tr>
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->name !!}</td>
                                <td><img src="{{ asset('images/front-end/product/'.explode(',', $row->images)[0]) }}" class="img-thumbnail" style="max-height: 150px;" ></td>
                                <td>{!! $row->description !!}</td>
                                <td><a href="{{ asset('admin/slide/insertSlide/'.$row->id) }}" class="btn btn-primary">Thêm</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            
            
        </form>
        
    </div>
</div>
    <script>
        $(document).ready(function(){
            $("#theloai").change(function(){
                var id = $(this).val();
                // alert(id);
                $.get("ajaxSlide/"+id,function(data){
                    // alert(data);
                    $("#product1").html(data);
                });

            });
        });
</script>
@endsection


    
