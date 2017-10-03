@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý người dùng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/user') !!}">Người dùng</a></li>
    <li>Thêm mới</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm người dùng</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    @if($errors->has('email'))
                        <div class='alert alert-danger'>{{ $errors->first('email') }}</div>
                    @endif
                    <label for="email">E-mail (<span class='required'>*</span>) </label>
                    <input id="email" name="email" class="form-control" type="email"
                           value="{!!old('email')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('name'))
                        <div class='alert alert-danger'>{{ $errors->first('name') }}</div>
                    @endif
                    <label for="name">Tên</label>
                    <input id="name" name="name" class="form-control" type="text"
                           value="{!!old('name')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('pass'))
                        <div class='alert alert-danger'>{{ $errors->first('pass') }}</div>
                    @endif
                    <label for="pass">Mật khẩu (<span class='required'>*</span>) </label>
                    <input id="pass" name="pass" class="form-control" type="password"
                           value="{!!old('pass')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('repass'))
                        <div class='alert alert-danger'>{{ $errors->first('repass') }}</div>
                    @endif
                    <label for="repass">Nhập lại Mật khẩu (<span class='required'>*</span>) </label>
                    <input id="repass" name="repass" class="form-control" type="password"
                           value="{!!old('repass')!!}">
                </div>

                <div class="form-group">
                    @if($errors->has('phone'))
                        <div class='alert alert-danger'>{{ $errors->first('phone') }}</div>
                    @endif
                    <label for="phone">Số điện thoại (<span class='required'>*</span>) </label>
                    <input id="phone" name="phone" class="form-control" type="text"
                           value="{!!old('phone')!!}">
                </div>

                @if(Auth::User()->level == 1)
                    <div class="form-group">
                        <label for="level">Loại thành viên</label>
                        <select name='level' id='level' class='form-control'>
                            @foreach($level as $key => $value)
                                @if(Auth::User()->level < $key)
                                <option value='{!!$key!!}' @if(old('level') == $key) selected @endif>
                                    {!! $value !!}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <button type='submit' class="btn btn-primary">Tạo mới</button>
                    <a href="{!! url('admin/user') !!}" class="btn btn-default">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
