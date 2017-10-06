@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý Thương Hiệu
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Danh Sách Thương Hiệu</li>
    <li><a href="{!! url('admin/brand/addBrand') !!}">Thêm Thương Hiệu</a></li>
@endsection

@section("content")

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách Thương Hiệu</h3>
    </div>
    @if(session('delete'))
        <div class="alert alert-success fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <b>{{session('delete')}}</b><br>           
        </div>
    @endif
    <div class="panel-body">
        <!-- list -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
                <tbody>
                @if(count($list) < 1)
                    <tr>
                        <td colspan="7">Chưa có dữ liệu</td>
                    </tr>
                @else
				@foreach($list as $br)
					<tr>
						<td>{{$br->id}}</td>
						<td>{{$br->name}}</td>
						<td><a href="{{ url('admin/brand/editBrand/'.$br->id) }}" class="btn btn-warning">Edit</a></td>
						<td><a href="{{ url('admin/brand/deleteBrand/'.$br->id) }}" class="btn btn-danger">Delete</a></td>
					</tr>
				@endforeach
				@endif
				</tbody>
			</table>
			{!! $list->links() !!}
		</div>
	</div>
</div>
@endsection