@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý Thương Hiệu
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/brand/') !!}">Danh Sách Thương Hiệu</a></li>
    <li>Xóa Thương Hiệu</li>
@endsection

@section("content")
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Bạn Có Chắc Chắn Muốn Xóa Thương Hiệu <b>{{$d->name}}</b></h3>
		</div>
		<div class="panel-body">
			<form action="" method="post">
				{{ csrf_field() }}
				<input type="submit" name="agree" value="Agree" class="btn btn-success">
				<input type="submit" name="disagree" value="Disagree" class="btn btn-danger">
			</form>
		</div>
	</div>

@endsection