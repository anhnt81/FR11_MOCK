@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý chuyên mục
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/category') !!}">Chuyên mục</a></li>
    <li>Thêm mới</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm chuyên mục</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form" id='addCatFrm'>
                {{ csrf_field() }}
                <div class="form-group">
                    @if($errors->has('name'))
                        <div class='alert alert-danger'>{{ $errors->first('name') }}</div>
                    @endif
                    <label for="name">Tên</label>
                    <input id="name" name="name" class="form-control" type="text"
                           value="@if(old('name')) {!! old('name') !!} @endif">
                </div>

                <div class="form-group">
                    @if($errors->has('parentId'))
                        <div class='alert alert-danger'>{{ $errors->first('parentId') }}</div>
                    @endif
                    <label for="parentId">Chuyên mục cha</label>
                    <select name='parentId' id='parentId' class='form-control'>
                        <option>Không có</option>
                        @foreach($list as $row)
                            <option value='{!! $row->id !!}' @if(old('parentId') == $row->id) selected @endif>{!! $row->name !!}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type='submit' class="btn btn-primary">Tạo mới</button>
                    <a href="{!! url('admin/category') !!}" class="btn btn-danger">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#addCatFrm').submit(function () {
                $('.err').remove();

                var name = $('#name').val();

                if(name.length <= 2) {
                    $('#name').before("<div class='alert alert-danger err'>Tên chuyên mục phải lớn hơn 2 ký tự</div>");
                    return false;
                }
                else {
                    return true;
                }
            });
        });
    </script>
@endsection
