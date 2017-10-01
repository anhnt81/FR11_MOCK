@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý khách hàng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Khách hàng</li>
@endsection

@section('content')
    <!-- main content  -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách khách hàng</h3>
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
                        <th>Tên</th>
                        <th>Giới tính</th>
                        <th>Số điện thoại</th>
                        <th>E-mail</th>
                        <th>Địa chỉ giao hàng</th>
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
                                <td>{!! $row->cus_id !!}</td>
                                <td>{!! $row->name !!}</td>
                                <td>
                                    @if($row->gender == 1) Nam
                                    @elseif($row->gender == 2) Nữ
                                    @else Khác
                                    @endif
                                </td>
                                <td>{!! $row->phone !!}</td>
                                <td>{!! $row->email !!}</td>
                                <td>{!! $row->address !!}</td>
                                <td>
                                    <a href="{!! url('admin/customer/sua-thong-tin/'.$row->cus_id) !!}"
                                       class="btn btn-default">
                                        <span class="glyphicon glyphicon-edit">Sửa</span>
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
                                       value='{!! $data['key'] !!}' placeholder='Nhập từ khóa'>
                                <select name='field_search' style='width : 35%' class='form-control'>
                                    <option value='name' @if($data['field'] == 'name') selected @endif>Theo tên</option>
                                    <option value='email' @if($data['field'] == 'email') selected @endif>Theo email</option>
                                    <option value='address' @if($data['field'] == 'address') selected @endif>Theo địa chỉ</option>
                                    <option value='phone' @if($data['field'] == 'phone') selected @endif>Theo số điện thoại</option>
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
                                            <input type='radio' name='sort' value='cus_id'
                                                <?php if(empty($data['sort']) || (isset($data['sort']) && $data['sort'] == 'cus_id')) echo 'checked'?>> ID
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

            if($(location).attr('href').indexOf('filter') != -1) {
                var a = $('.pagination a');
                var page;

                for (var i = 0; i < a.length; i++){
                    page = $(a[i]).attr('href').split('?');
                    page = page[page.length - 1];
                    $(a[i]).attr('href', $(location).attr('href') + '&' + page);
                }
            }
        })
    </script>
@endsection
