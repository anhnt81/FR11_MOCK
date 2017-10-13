@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý chuyên mục
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Người dùng</li>
@endsection

@section('content')
    <!-- main content  -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách người dùng</h3>
        </div>
        <div class="panel-body">
            <div>
                <div class='col-xs-12 col-md-6'>
                    <a class='btn btn-primary' role='button' href='{!! url('admin/user/them-moi') !!}'>
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
                @if(!empty(session('success')))
                    <div class='alert alert-success'>{{session('success')}}</div>
                @endif
                @if(!empty(session('error')))
                    <div class='alert alert-danger'>{{session('error')}}</div>
                @endif
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày tạo</th>
                        <th>Chức vụ</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($list) < 1)
                        <tr>
                            <td colspan="4">Chưa có dữ liệu</td>
                        </tr>
                    @else
                        @foreach($list as $row)
                            <tr>
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->name !!}</td>
                                <td><img src='{!! asset('uploads/images/' . $row->avatar) !!}' class='img-ava'>
                                </td>
                                <td>{!! $row->email !!}</td>
                                <td>{!! $row->phone !!}</td>
                                <td>{!! $row->created_at !!}</td>
                                <td>{!! $row->slevel !!}</td>
                                <td>@if($row->status == 1) Hoạt động @else Khóa @endif</td>
                                <td>
                                    @if(Auth::guard('admin')->User()->level < $row->level || Auth::guard('admin')->User()->id == $row->id)
                                        <a href="{!! url('admin/user/sua-thong-tin/'.$row->id) !!}"
                                           class="btn btn-warning">
                                            <span class="glyphicon glyphicon-edit"></span>
                                            Sửa
                                        </a>
                                        @if($row->level != 1)
                                            <button type='button' class="btn btn-danger btn-del"
                                                    frm-id='{{$row->id}}' link='{!! url('admin/user/xoa') !!}'>
                                                <span class="glyphicon glyphicon-remove"></span>
                                                Xóa
                                            </button>
                                        @endif
                                    @endif
                                </td>
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
                            Trong {{ $total }} Người dùng.
                        </div>
                    @endif
                    {!! $list->links() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- ===================================== -->

    <!-- modal filter -->
    <div id='filter-modal' class='modal fade' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form role='form'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h3>Lọc người dùng</h3>
                    </div>

                    <div class='modal-body'>
                    {{--{{ csrf_field() }}--}}
                    <!-- search -->
                        <div class='form-group'>
                            <label for='search-user'>Tìm kiếm</label>
                            <div id='search-user'>
                                <input type='search' name='search' class='form-control form-val'
                                       style='width : 60%; float:left; margin-right: 10px'
                                       value='<?php if (isset($data['key'])) echo $data['key'] ?>'
                                       placeholder='Nhập từ khóa'>
                                <select name='field_search' style='width : 35%' class='form-control form-val'>
                                    <option value='name'
                                            @if(isset($data['field']) && $data['field'] == 'name') selected @endif>Theo
                                        tên
                                    </option>
                                    <option value='email'
                                            @if(isset($data['field']) && $data['field'] == 'email') selected @endif>Theo
                                        email
                                    </option>
                                    <option value='phone'
                                            @if(isset($data['field']) && $data['field'] == 'phone') selected @endif>Theo
                                        số điện thoại
                                    </option>
                                </select>
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
                                        <div class='col-md-4'>
                                            <input type='radio' name='sort' value='email' class='form-val'
                                            <?php if (isset($data['sort']) && $data['sort'] == 'email') echo 'checked'?>>
                                            E-mail
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

                        <!-- level filter -->
                        <div class='form-group'>
                            <label for='status-order'>Chức vụ</label>
                            <select id='status-order' class='form-control form-val' name='level'>
                                <option value='0' @if(empty($data['level'])) selected @endif>--Tất cả--</option>
                                @foreach($level as $key => $item)
                                    <option value='{!! $key !!}'
                                            @if(isset($data['level']) && $data['level'] == $key)
                                            selected
                                            @endif>{!! $item !!}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- status filter -->
                        <div class='form-group'>
                            <label for='status-user'>Tình trạng</label>
                            <div id='status-user' class='form-control-static'>
                                <div class='col-xs-4 col-md-4'>
                                    <input type='radio' name='status' value='0' class='form-val'
                                    <?php if (empty($data['status'])) echo 'checked'?>>
                                    Tất cả
                                </div>
                                <div class='col-xs-4 col-md-4'>
                                    <input type='radio' name='status' value='1' class='form-val'
                                    <?php if (isset($data['status']) && $data['status'] == 1) echo 'checked'?>>
                                    Hoạt Động
                                </div>
                                <div class='col-xs-4 col-md-4'>
                                    <input type='radio' name='status' value='2' class='form-val'
                                    <?php if (isset($data['status']) && $data['type'] == 2) echo 'checked'?>>
                                    Khóa
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

    @include('back-end.common.remove-modal')
@endsection
