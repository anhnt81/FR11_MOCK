@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý chuyên mục
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/category') !!}">Chuyên mục</a></li>
    <li>Sửa thông tin</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa thông tin chuyên mục</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form" id='ediCatFrm'>
                {{ csrf_field() }}
                <div class="form-group">
                    @if($errors->has('name'))
                        <div class='alert alert-danger'>{{ $errors->first('name') }}</div>
                    @endif
                    <label for="name">Tên</label>
                    <input id="name" name="name" class="form-control" type="text"
                           value="@if(old('name')) {!! old('name') !!} @else {!! $cat->name !!} @endif">
                </div>

                <div class="form-group">
                    @if($errors->has('parentId'))
                        <div class='alert alert-danger'>{{ $errors->first('parentId') }}</div>
                    @endif
                    <label for="parentId">Chuyên mục cha</label>
                    <select id='parentId' name='parentId' class='form-control'>
                        <option>Không có</option>
                        @foreach($list as $row)
                            <option value='{!! $row->id !!}'
                                    @if(old('parentId'))
                                        @if(old('parentId') == $row->id)
                                            selected
                                        @endif
                                    @elseif ($cat->parentId == $row->id)
                                        selected
                                    @endif>
                                {!! $row->name !!}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type='hidden' name='id' value='{!! $cat->id !!}'>
                    <button class="btn btn-primary">Lưu</button>
                    <a href="{!! url('admin/category') !!}" class="btn btn-danger">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#ediCatFrm').submit(function () {
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
