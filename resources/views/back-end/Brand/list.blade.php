@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý Thương Hiệu
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Thương Hiệu</li>
@endsection

@section("content")

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách Thương Hiệu</h3>
    </div>

    <div class="panel-body">
        <div>
            <div class='col-xs-12 col-md-6'>
                <a class='btn btn-primary' role='button' href='{!! url('admin/brand/addBrand') !!}'>
                    <span class='glyphicon glyphicon-plus'></span> Thêm mới
                </a>
                <button class="btn btn-primary" role='button' data-toggle='modal' data-target='#filter-modal'>
                    <span class='glyphicon glyphicon-filter'></span> Lọc
                </button>
            </div>

            <form role='form' class='form-horizontal col-xs-12 col-md-6'>
                <div class='form-group'>
                    <label for='per' class='col-xs-5 col-md-3 col-md-offset-6' style='margin-top : 10px; text-align: right'>Hiển thị</label>
                    <div class='col-xs-7 col-md-3'>
                        <select name='per' class='form-control form-val' id='per'>
                            <option value='5' @if($data['per'] == 5) selected @endif>5</option>
                            <option value='7' @if($data['per'] == 7) selected @endif>7</option>
                            <option value='10' @if($data['per'] == 10) selected @endif>10</option>
                            <option value='20' @if($data['per'] == 20) selected @endif>20</option>
                            <option value='50' @if($data['per'] == 50) selected @endif>50</option>
                            <option value='100' @if($data['per'] == 100) selected @endif>100</option>
                        </select>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
        <!-- list -->
        <div class="table-responsive" id='list-data'>
            @if(session('delete'))
                <div class="alert alert-success fade in alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b>{{session('delete')}}</b><br>
                </div>
            @endif
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

            <!-- pagination -->
            <hr>
            <div style='padding: 0 40px;'>
                @if($total > 0)
                    <div style='float:left;'>
                        Hiển thị : {{ $start }} <span class='glyphicon glyphicon-arrow-right'></span> {{ $end }}
                        Trong {{ $total }} Thương hiệu.
                    </div>
                @endif
                {!! $list->links() !!}
            </div>
		</div>
	</div>
</div>

<!-- modal filter -->
<div id='filter-modal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <form role='form'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h3>Lọc thương hiệu</h3>
                </div>

                <div class='modal-body'>
                {{--{{ csrf_field() }}--}}
                <!-- search -->
                    <div class='form-group'>
                        <label for='search-user'>Tìm kiếm</label>
                        <div id='search-user'>
                            <input type='search' name='search' class='form-control form-val'
                                   value='<?php if (isset($data['key'])) echo $data['key'] ?>'
                                   placeholder='Nhập tên thương hiệu'>
                        </div>
                    </div>

                    <!-- sort -->
                    <div class='form-group'>
                        <label for='sort-cat'>Sắp xếp</label>
                        <div id='sort-cat' class='form-control-static sort-frm'>
                            <div class='form-group'>
                                <label for='feild-sort'>Sắp xếp theo :</label>
                                <div id='feild-sort' class='form-control-static'>
                                    <div class='col-md-4'>
                                        <input type='radio' name='sort' value='id' class='form-val'
                                        <?php if (empty($data['sort']) || (isset($data['sort']) && $data['sort'] == 'id')) echo 'checked'?>>
                                        ID
                                    </div>
                                    <div class='col-md-4'>
                                        <input type='radio' name='sort' value='name' class='form-val'
                                        <?php if (isset($data['sort']) && $data['sort'] == 'name') echo 'checked'?>>
                                        Tên
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class='form-group'>
                                <label for='type-sort'>Kiểu sắp xếp :</label>
                                <div id='type-sort' class='form-control-static'>
                                    <div class='col-xs-6 col-md-6'>
                                        <input type='radio' name='type_sort' value='asc' class='form-val'
                                        <?php if (empty($data['type']) || isset($data['type']) && $data['type'] == 'asc') echo 'checked'?>>
                                        Tăng dần
                                    </div>
                                    <div class='col-xs-6 col-md-6'>
                                        <input type='radio' name='type_sort' value='desc' class='form-val'
                                        <?php if (isset($data['type']) && $data['type'] == 'desc') echo 'checked'?>>
                                        Giảm dần
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='modal-footer'>
                    <button type="button" id='btn-filter' class='btn btn-success'>Tìm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection