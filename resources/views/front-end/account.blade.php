@extends('front-end.layouts.master')

@section('title')
    Thông tin cá nhân
@endsection
@section('content')
    <div class='col-xs-12 col-md-8 col-md-offset-2'>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin cá nhân</h3>
            </div>
            <div class="panel-body">
                <form method="post" role="form"  enctype="multipart/form-data">
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
                        <input type='file' name='avatar' onchange='previewImage(this, "pv-ava-user")' id='avatar'>
                        <img id='pv-ava-user' src='{{asset('uploads/images/'.$user->avatar)}}'
                             style='max-height: 97px;'>
                    </div>

                    <div class="form-group">
                        @if($errors->has('phone'))
                            <div class='alert alert-danger'>{{ $errors->first('phone') }}</div>
                        @endif
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" name="phone" class="form-control" type="text"
                               value="@if(old('phone')) {!!old('phone')!!} @else {!!$user->phone!!} @endif">
                    </div>

                    <div class="form-group">
                        <input type='hidden' name='id' value='{!! $user->id !!}'>
                        <button type='submit' class="btn btn-primary">Lưu</button>
                        <a href="{!! url('/') !!}" class="btn btn-default">Quay Lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection