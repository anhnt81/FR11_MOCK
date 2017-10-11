@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý chuyên mục
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Chuyên mục</li>
@endsection

@section('content')
    <!-- main content  -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách chuyên mục</h3>
        </div>
        <div class="panel-body">
            <div>
                <div class='col-xs-12 col-md-6'>
                    <a class='btn btn-primary' role='button' href='{!! url('admin/category/them-moi') !!}'>
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
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Chuyên mục cha</th>
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
                                <td>@if(!empty($row->child->name)) {!! $row->child->name !!} @endif</td>
                                <td>
                                    <a href="{!! url('admin/category/sua-thong-tin/'.$row->id) !!}"
                                       class="btn btn-warning" style='margin-right:10px;float:left;'>
                                        <span class="glyphicon glyphicon-edit"></span>
                                        Sửa
                                    </a>
                                    <button type='button' class="btn btn-danger btn-del"
                                            frm-id='{{$row->id}}' link='{!! url('admin/category/xoa') !!}'>
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Xóa
                                    </button>
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
                            Trong {{ $total }} Chuyên mục.
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
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h3>Lọc chuyên mục</h3>
                </div>

                <div class='modal-body'>
                    <form method='get' action='{!! url('admin/category/filter') !!}' role='form' id='filter-cat-frm'>
                    {{--{{ csrf_field() }}--}}
                    <!-- search -->
                        <div class='form-group'>
                            <label for='search-cat'>Tìm kiếm</label>
                            <div id='search-cat'>
                                <input type='search' name='search' class='form-control form-val'
                                       value='<?php if (isset($data['key'])) echo $data['key'] ?>'
                                       placeholder='Nhập tên chuyên mục......'>
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
                                            <input type='radio' name='sort' value='parentId' class='form-val'
                                            <?php if (isset($data['sort']) && $data['sort'] == 'parentId') echo 'checked'?>>
                                            Chuyên mục cha
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
                    </form>
                </div>

                <div class='modal-footer'>
                    <button type="button" id='btn-filter' class='btn btn-success'>Tìm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    @include('back-end.common.remove-modal')
@endsection
