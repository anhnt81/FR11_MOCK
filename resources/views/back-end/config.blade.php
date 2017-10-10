@extends('back-end.layouts.layout-admin')
@section('title')
    Config
@endsection

@section('breadcrumb')
    <li><a href="{{ url('admin')}}"> Trang chủ</a></li>
@endsection

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Config</h3>
	</div>
	@if(count($errors)>0)
		@foreach($errors->all() as $err)
			<div class="alert alert-danger">{{$err}}</div><br>
		@endforeach
	@endif

	@if(session('success_paginate'))
		<div class="alert alert-success">{{session('success_paginate')}}</div>
	@endif
	<div class="panel-body">
		
		<form action="" method="post">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="paginate">Số Sản Phẩm Trong Một Trang Hiện Tại: @if(session('pa')) {{session('pa')}} @else {{$pa}} @endif</label>
				<input type="text" name="paginate" class="form-control" placeholder="Thiết lập sản phẩm trong một trang"><br>
				<input type="submit" name="submit" class="btn btn-primary" value="Lưu">
			</div>
		</form>
		
	</div>
</div>
@endsection
