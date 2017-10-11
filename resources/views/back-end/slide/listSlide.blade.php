@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý Slide
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Danh sách slide</li>
@endsection

@section('content')
    <!-- main content  -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách Slide</h3>
        </div>
        @if(session('deSlide'))
            <div class="alert alert-success fade in alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b>{{session('deSlide')}}</b><br>           
            </div>
        @endif
        @if(session('swap'))
            <div class="alert alert-success fade in alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b>{{session('swap')}}</b><br>          
            </div>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $err)
                <div class="alert alert-danger fade in alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b>{{$err}}</b><br>         
                </div>
            @endforeach
        @endif

        <div class="panel-body">
            <div>
                <a href="{!! url('admin/slide/addSlide') !!}" class='btn btn-primary'>Thêm Slide</a>
            </div>
            <!-- list -->
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Mô Tả</th>
                        <th>Thứ Tự</th>
                        <th>Đổi Thứ Tự</th>
                        <th>Xóa Slide</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($list) < 1)
                        <tr>
                            <td colspan="7">Chưa có dữ liệu</td>
                        </tr>
                    @else
                        @foreach($list as $row)
                            <tr>
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->product->name !!}</td>
                                <td><img src="{{ asset('images/front-end/product/'.explode(',', $row->product->images)[0]) }}" class="img-thumbnail img-ava"></td>
                                <td style="max-width:200px;">{!! $row->product->description !!}</td>
                                <td>
                                    <input type="text" name="ordinal" value="{!! $row->ordinal !!}" size="1" style="text-align: center;padding:5px;border-radius:5px;border: 1px solid #ccc;" disabled=""></td>
                                <td>
                                    <form action="{{ url('admin/slide/swapSlide') }}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="stt" value="{!! $row->ordinal !!}" >
                                        <input type="text" name="swap" size="1" 
                                               style="text-align: center;padding:5px;border-radius:5px;border: 1px solid #ccc;">
                                        <input type="submit" name="submit" value="Đổi" class="btn btn-primary">
                                    </form>
                                </td>
                                <td><!-- <a href="{{ url('admin/slide/deleteSlide/'.$row->id)}}" class="btn btn-danger">Xóa</a> -->
                                    <button type='button' class="btn btn-danger btn-del"
                                            frm-id='{{$row->id}}' link='{!! url('admin/slide/deleteSlide') !!}'>
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
            <!-- pagination -->
            <hr>
            <div style="text-align: center">
                {!! $list->links() !!}
            </div>
        </div>
    </div>
    <!-- ===================================== -->
    <!-- modal -->
        <!-- <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>This is a small modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
      </div> -->
      <!--end modal -->
      @include('back-end.common.remove-modal')
@endsection