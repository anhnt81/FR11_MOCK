@extends('front-end.layouts.master')

@section('title')
Đăng kí
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="index.html">Home</a> / <span>Đăng kí</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Đăng ký</h3>
                </div>
                <div class="panel-body">
                    <form method="post" role="form" id='addUserFrm'>
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

                        <div class="form-group">
                            <button type='submit' class="btn btn-primary">Đăng ký</button>
                            <a href="{!! url('/') !!}" class="btn btn-default">Quay Lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection