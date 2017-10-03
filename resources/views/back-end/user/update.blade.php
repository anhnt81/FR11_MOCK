@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý người dùng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/user') !!}">Người dùng</a></li>
    <li>Cập nhật thông tin</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa thông tin người dùng</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    @if($errors->has('email'))
                        <div class='alert alert-danger'>{{ $errors->first('email') }}</div>
                    @endif
                    <label for="email">E-mail</label>
                    <input id="email" name="email" class="form-control" type="email"
                           value="@if(old('email')) {!!old('email')!!} @else {{$user->email}} @endif">
                </div>


                <div class="form-group">
                    @if($errors->has('name'))
                        <div class='alert alert-danger'>{{ $errors->first('name') }}</div>
                    @endif
                    <label for="name">Tên</label>
                    <input id="name" name="name" class="form-control" type="text"
                           value="@if(old('name')) {!!old('name')!!} @else {{$user->name}} @endif">
                </div>

                <div class="form-group">
                    @if($errors->has('pass'))
                        <div class='alert alert-danger'>{{ $errors->first('pass') }}</div>
                    @endif
                    <label for="pass">Mật khẩu Mới</label>
                    <input id="pass" name="pass" class="form-control" type="password"
                           value="{!!old('pass')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('repass'))
                        <div class='alert alert-danger'>{{ $errors->first('repass') }}</div>
                    @endif
                    <label for="repass">Nhập lại Mật khẩu </label>
                    <input id="repass" name="repass" class="form-control" type="password"
                           value="{!!old('phone')!!}">
                </div>

                <div class='form-group'>
                    <label for='avatar'>Ảnh đại diện</label>
                    @if($errors->has('avatar'))
                        <div class='alert alert-danger'>{{ $errors->first('avatar') }}</div>
                    @endif
                    <input type='file' name='avatar' onchange='previewImage(this, "pv-ava-user")' id='avatar' class='form-val'>
                    <img id='pv-ava-user' src='{{asset('public/uploads/images/'.$user->avatar)}}'
                         style='max-height: 60px;'>
                </div>

                <div class="form-group">
                    @if($errors->has('phone'))
                        <div class='alert alert-danger'>{{ $errors->first('phone') }}</div>
                    @endif
                    <label for="phone">Số điện thoại</label>
                    <input id="phone" name="phone" class="form-control" type="text"
                           value="@if(old('phone')) {!!old('phone')!!} @else {!!$user->phone!!} @endif">
                </div>

                @if(Auth::User()->level < $user->id)
                    <div class="form-group">
                        <label for="level">Loại thành viên</label>
                        <select name='level' id='level' class='form-control'>
                            @foreach($level as $key => $value)
                                <option value='{!!$key!!}'
                                        @if(old('level'))
                                            @if(old('level') == $key)
                                                selected
                                            @endif
                                        @else
                                            @if($user->level == $key)
                                                selected
                                            @endif
                                        @endif>
                                    {!! $value !!}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class='form-group'>
                        <label for='status'>Trạng thái</label>
                        <select id='status' name='status' class='form-control'>
                            <option value='1' @if(old('status'))
                                @if(old('status') == 1)
                                    selected
                                @endif
                            @else
                                @if($user->status == 1) selected @endif
                            @endif>Hoạt động</option>
                            <option value='2' @if(old('status'))
                                @if(old('status') == 2) selected @endif
                                @else
                                    @if($user->status == 2) selected @endif
                                @endif>Khóa</option>
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <input type='hidden' name='id' value='{!! $user->id !!}'>
                    <button type='submit' class="btn btn-primary">Lưu</button>
                    <a href="{!! url('admin/user') !!}" class="btn btn-default">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
