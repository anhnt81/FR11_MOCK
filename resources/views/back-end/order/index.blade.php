@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý đơn hàng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Đơn hàng</li>
@endsection

@section('content')
    <!-- main content  -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách đơn hàng</h3>
        </div>
        <div class="panel-body">
            <!-- filter -->
            <div>
                <button class="btn btn-primary" role='button' data-toggle='modal' data-target='#filter-modal'>
                    <span class='glyphicon glyphicon-filter'></span> Lọc
                </button>
            </div>

            <!-- list -->
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ghi chú</th>
                        <th>Tình trạng</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($list) < 1)
                        <tr>
                            <td colspan="7">Chưa có dữ liệu</td>
                        </tr>
                    @else
                        @foreach($list as $row)
                            <tr>
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->cus !!}</td>
                                <td>{!! $row->total !!}</td>
                                <td>{!! $row->note !!}</td>
                                <td>{!! $row->status !!}</td>
                                <td>
                                    <a href="{!! url('admin/order/chi-tiet/'.$row->id) !!}"
                                       class="btn btn-default">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- pagination -->
            <hr>
            <div style="text-align: center">
                {!! $list->links() !!}
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
                    <h3>Lọc khách hàng</h3>
                </div>

                <div class='modal-body'>
                    <form method='get' action='{!! url('admin/customer/filter') !!}' role='form' id='filter-cus-frm'>
                    {{--{{ csrf_field() }}--}}
                    <!-- search -->
                        <div class='form-group'>
                            <label for='search-cus'>Tìm kiếm</label>
                            <div id='search-cus'>
                                <input type='search' name='search' class='form-control' style='width : 60%; float:left; margin-right: 10px'
                                       value='<?php if(isset($data['key'])) echo $data['key'] ?>' placeholder='Nhập từ khóa'>
                                <select name='field_search' style='width : 35%' class='form-control'>
                                    <option value='name' @if(isset($data['field']) && $data['field'] == 'name') selected @endif>Theo tên</option>
                                    <option value='email' @if(isset($data['field']) && $data['field'] == 'email') selected @endif>Theo email</option>
                                    <option value='address' @if(isset($data['field']) && $data['field'] == 'address') selected @endif>Theo địa chỉ</option>
                                    <option value='phone' @if(isset($data['field']) && $data['field'] == 'phone') selected @endif>Theo số điện thoại</option>
                                </select>
                            </div>
                        </div>

                        <!-- sort -->
                        <div class='form-group'>
                            <label for='sort-cus'>Sắp xếp</label>
                            <div id='sort-cus' class='form-control-static'>
                                <div class='form-group'>
                                    <label for='feild-sort'>Sắp xếp theo :</label>
                                    <div id='feild-sort' class='form-control-static'>
                                        <div class='col-xs-6 col-md-2'>
                                            <input type='radio' name='sort' value='name'
                                            <?php if(isset($data['sort']) && $data['sort'] == 'name') echo 'checked'?>> Tên
                                        </div>
                                        <div class='col-xs-6 col-md-2'>
                                            <input type='radio' name='sort' value='id'
                                            <?php if(empty($data['sort']) || (isset($data['sort']) && $data['sort'] == 'id')) echo 'checked'?>> ID
                                        </div>
                                        <div class='col-xs-6 col-md-2'>
                                            <input type='radio' name='sort' value='email'
                                            <?php if(isset($data['sort']) && $data['sort'] == 'email') echo 'checked'?>> E-mail
                                        </div>
                                        <div class='col-xs-6 col-md-3'>
                                            <input type='radio' name='sort' value='address'
                                            <?php if(isset($data['sort']) && $data['sort'] == 'address') echo 'checked'?>> Địa chỉ
                                        </div>
                                        <div class='col-xs-12 col-md-3'>
                                            <input type='radio' name='sort' value='phone'
                                            <?php if(isset($data['sort']) && $data['sort'] == 'phone') echo 'checked'?>> Số điện thoại
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class='form-group'>
                                    <label for='type-sort'>Kiểu sắp xếp :</label>
                                    <div id='type-sort' class='form-control-static'>
                                        <div class='col-xs-6 col-md-6'>
                                            <input type='radio' name='type_sort' value='asc'
                                            <?php if(empty($data['type']) || isset($data['type']) && $data['type'] == 'asc') echo 'checked'?>>
                                            Tăng dần
                                        </div>
                                        <div class='col-xs-6 col-md-6'>
                                            <input type='radio' name='type_sort' value='desc'
                                            <?php if(isset($data['type']) && $data['type'] == 'desc') echo 'checked'?>>
                                            Giảm dần
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class='modal-footer'>
                    <button type="button" id='btn-filter-cus' class='btn btn-success'>Tìm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#btn-filter-cus').click(function () {
                $('#filter-cus-frm').submit();
            });
        })
    </script>
@endsection

