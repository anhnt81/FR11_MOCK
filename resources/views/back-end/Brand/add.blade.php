@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý Thương Hiệu
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/brand/') !!}">Danh Sách Thương Hiệu</a></li>
    <li>Thêm Thương Hiệu</li>
@endsection
@section("content")
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Thêm Thương Hiệu</h3>
	</div>
	<div class="panel-body">
		<form action="{{route('postBrand')}}" method="post">
			{{ csrf_field() }}
			@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach($errors->all() as $err)
						{{$err}}<br>
					@endforeach
				</div>
			@endif
			@if(session('success'))
				<div class="alert alert-success">
					{{session('success')}}
				</div>
			@endif
			@if(session('duplicate'))
				<div class="alert alert-danger">
					{{session('duplicate')}}
				</div>
			@endif
			<input type="text" name="namebrand" placeholder="Tên Thương Hiệu" class="form-control"><br>
			<input type="submit" name="submit" value="Thêm" class="btn btn-primary">
		</form>
	</div>
</div>
@endsection