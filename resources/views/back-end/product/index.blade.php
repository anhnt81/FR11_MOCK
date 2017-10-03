@extends('back-end.layouts.layout-admin')

@section('content')
    <!-- main content  -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách sản phẩm</h3>
        </div>
        <div class="panel-body">
            <!-- filter -->
            <div>
                <button class="btn btn-primary" role='button' data-toggle='modal' data-target='#filter-modal'>
                    <span class='glyphicon glyphicon-filter'></span> Lọc
                </button>
                @if(Session::has('message'))
                    <p style="text-align:center;color:red">{{Session::get('message')}}</p>
                @endif
            </div>
            <!-- Modal create Product -->
                <form onsubmit ="return validateForm()" enctype="multipart/form-data"  method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-default" style="margin-top:15px"><i  class="fa fa-plus"></i>Thêm Sản Phẩm</a>
                    <div class="modal fade" tabindex="-1" id="myModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Product</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Image<input type="file" name="image" id="file" multiple=""></p>
                                    <p>Name<input type="text" name="name" id="name" class="form-control"></p>
                                    <p>Category
                                        <select class="form-control" selected="" id="category" name="category">
                                            <option id="type" value="0">Select</option>
                                            @foreach($category as $cat)
                                                <option id="type" value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p>Brand
                                        <select class="form-control" selected="" id="brand" name="brand">
                                            <option id="type" value="0">Select</option>
                                            @foreach($brands as $brand)
                                                <option id="type" value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p>Description<input type="text" name="description" id="description" class="form-control"></p>
                                    <p>Unit Price<input type="text" name="unit_price" id="unit_price" class="form-control"></p>
                                    <p>Promotion Price<input type="text" name="promotion_price" id="promotion_price" class="form-control"></p>
                                    <p>Quantity<input type="text" name="quantity" id="quantity" class="form-control"></p>
                                    {{--Show message error --}}
                                    <div id="error" style="display: none;"  class="alert alert-danger" role="alert"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="addButton">Save</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </form>
<script type="text/javascript">
    function validateForm() {
        var name = $("#name").val().trim();
        var category = $('select[name=category]').val();
        var brand = $('select[name=brand]').val();
        var image = $("#file").val();
        var quantity = $("#quantity").val().trim();
        var unit_price = $("#unit_price").val().trim();
        var promotion_price = $("#promotion_price").val().trim();
        var description = $("#description").val().trim();

        if(name == "" || category == 0 || brand == 0 || image == "" || quantity == "" || promotion_price == "" || description == "" || unit_price ==""){
            $("#error").css("display","block");
            document.getElementById('error').innerHTML = "Bạn chưa nhập đầy đủ dữ liệu";
            return false;
        }
    }
</script>
<!-- list  Product-->
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Images</th>
                        <th>Unit Price</th>
                        <th>Promotion Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($products) < 1)
                        <tr>
                            <td colspan="7">Chưa có dữ liệu</td>
                        </tr>
                    @else
                        @foreach($products as $row)
                            <tr>
                                <td>{!! $row->id !!}</td>
                                <td width="100px;">{!! $row->name !!}</td>
                                <td width="300px;">{!! $row->description !!}</td>
                                {{--<td><img src="images/front-end/product/{!! $row->images !!}" /></td>--}}
                                <td><img style="height: 80px;width: 90px;" src="{{asset('images/front-end/product/'.$row->images)}}" /></td>
                                <td>{!! $row->unit_price !!}</td>
                                <td>{!! $row->promotion_price !!}</td>
                                <td align="center">{!! $row->qty !!}</td>
                                <td>
                                    <a href="{!! url('admin/edit-product/'.$row->id) !!}"
                                       class="btn btn-default">
                                        <span class="glyphicon glyphicon-edit">Sửa</span>
                                    </a>
                                    <a href="{!!url('admin/sanpham/del/'.$row->id)!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')"><span class="glyphicon glyphicon-remove">remove</span> </a>
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
                {!! $products->links() !!}
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
