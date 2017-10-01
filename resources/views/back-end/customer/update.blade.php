@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý khách hàng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/customer') !!}">Khách hàng</a></li>
    <li>{!! $cus->name !!}</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa thông tin khách hàng {!! $cus->name !!}</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    @if($errors->has('name'))
                        <div class='alert alert-danger'>{{ $errors->first('name') }}</div>
                    @endif
                    <label for="name">Tên</label>
                    <input id="name" name="name" class="form-control" type="text"
                           value="@if(old('name')) {!! old('name') !!} @else {!! $cus->name !!} @endif">
                </div>

                <div class="form-group">
                    @if($errors->has('phone'))
                        <div class='alert alert-danger'>{{ $errors->first('phone') }}</div>
                    @endif
                    <label for="phone">Số điện thoại</label>
                    <input id="phone" name="phone" class="form-control" type="text"
                           value="@if(old('phone')) {!! old('phone') !!} @else {!! $cus->phone !!} @endif">
                </div>

                <div class="form-group">
                    @if($errors->has('email'))
                        <div class='alert alert-danger'>{{ $errors->first('email') }}</div>
                    @endif
                    <label for="email">E-mail</label>
                    <input id="email" name="email" class="form-control" type="email"
                           value="@if(old('email')) {!! old('email') !!} @else {!! $cus->email !!} @endif">
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ giao hàng</label>
                    <input id="address" name="address" class="form-control" type="text"
                           value="@if(old('address')) {!! old('address') !!} @else {!! $cus->address !!} @endif">
                </div>

                <div class="form-group">
                    <label for="gender">Giới tính</label>
                    <select id="gender" class="form-control" name="gender">
                        <option value="1"
                                @if(old('gender'))
                                    @if(old('gender') == 1) selected @endif
                                @elseif($cus->gender == 1) selected
                                @endif>
                            Nam
                        </option>
                        <option value="2"
                                @if(old('gender'))
                                @if(old('gender') == 2) selected @endif
                                @elseif($cus->gender == 2) selected
                                @endif>
                            Nữ
                        </option>
                        <option value="3"
                                @if(old('gender'))
                                @if(old('gender') == 3) selected @endif
                                @elseif($cus->gender == 3) selected
                                @endif>
                            Khác
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Lưu</button>
                    <a href="{!! url('admin/customer') !!}" class="btn btn-danger">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
