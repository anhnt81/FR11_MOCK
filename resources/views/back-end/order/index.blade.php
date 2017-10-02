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
                                <td>{!! $row->cid !!}</td>
                                <td>{!! $row->total !!}</td>
                                <td>{!! $row->note !!}</td>
                                <td>{!! $row->st !!}</td>
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
                    <form method='get' action='{!! url('admin/order/filter') !!}' role='form' id='filter-cus-frm'>
                    {{--{{ csrf_field() }}--}}
                    <!-- search -->
                        <div class='form-group'>
                            <label for='search-order'>Tìm kiếm</label>
                            <div id='search-order'>
                                <input type='search' name='search' class='form-control'
                                       value='<?php if (isset($data['key'])) echo $data['key'] ?>'
                                       placeholder='Nhập tên khác'>
                            </div>
                        </div>

                        <!-- sort -->
                        <div class='form-group'>
                            <label for='sort-order'>Sắp xếp</label>
                            <div id='sort-order' class='form-control-static sort-frm'>
                                <div class='form-group'>
                                    <label for='feild-sort'>Sắp xếp theo :</label>
                                    <div id='feild-sort' class='form-control-static'>
                                        <div class='col-xs-4 col-md-4'>
                                            <input type='radio' name='sort' value='id'
                                            <?php if (empty($data['sort']) || (isset($data['sort']) && $data['sort'] == 'id')) echo 'checked'?>>
                                            ID
                                        </div>
                                        <div class='col-xs-4 col-md-4'>
                                            <input type='radio' name='sort' value='name'
                                            <?php if (isset($data['sort']) && $data['sort'] == 'name') echo 'checked'?>>
                                            Tên khách hàng
                                        </div>
                                        <div class='col-xs-4 col-md-4'>
                                            <input type='radio' name='sort' value='total'
                                            <?php if (isset($data['sort']) && $data['sort'] == 'total') echo 'checked'?>>
                                            Tổng tiền
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class='form-group'>
                                    <label for='type-sort'>Kiểu sắp xếp :</label>
                                    <div id='type-sort' class='form-control-static'>
                                        <div class='col-xs-6 col-md-6'>
                                            <input type='radio' name='type_sort' value='asc'
                                            <?php if (empty($data['type']) || isset($data['type']) && $data['type'] == 'asc') echo 'checked'?>>
                                            Tăng dần
                                        </div>
                                        <div class='col-xs-6 col-md-6'>
                                            <input type='radio' name='type_sort' value='desc'
                                            <?php if (isset($data['type']) && $data['type'] == 'desc') echo 'checked'?>>
                                            Giảm dần
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- status filter -->
                        <div class='form-group'>
                            <label for='status-order'>Tình trạng</label>
                            <select id='status-order' class='form-control' name='status'>
                                @foreach($status as $key => $item)
                                    <option value='{!! $key !!}'>{!! $item !!}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- money filter -->
                        <div class='form-group'>
                            <label for='money-order'>Tiền</label>
                            <div id='money-order' class='form-control-static'>
                                <input class='form-control' type='number' name='from' style='width:45%;float: left;margin-right: 10px'>
                                <span> To </span>
                                <input class='form-control' type='number' name='to' style='width:45%; float: right'>
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

