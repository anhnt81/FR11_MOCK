<nav class='col-md-3 col-lg-2 collapse' id='nav-home'>
    <div style='text-align: center'>
        <img src='{{asset('uploads/images/'. Auth::guard('admin')->User()->avatar )}}' class="img-circle" style="max-width: 80px"><br>
        <span>{{Auth::guard('admin')->User()->name}}</span>
    </div>
    <hr color="darkgray">
    <ul class="nav nav-pills nav-stacked" role="tablist" style='border: none'>
        <li id='home' class='active'>
            <a href="{!! url('admin') !!}"> <span class="glyphicon glyphicon-home"></span> Trang Chủ</a>
        </li>

        <li id='user' class="dropdown">
            <a href="{!! url('admin/user') !!}">
                <span class="glyphicon glyphicon-user"></span> Quản Lý Người Dùng</span>
            </a>
        </li>

        <li id='customer' class="dropdown">
            <a href="{!! url('admin/customer') !!}">
                <span class="glyphicon glyphicon-user"></span> Quản Lý Khách Hàng
            </a>
        </li>

        <li id='product' class="dropdown">
            <a href="{!! url('admin/product') !!}">
                <span class="glyphicon glyphicon-gift"></span> Quản lý Sản Phẩm
            </a>
        </li>

        <li id='order' class="dropdown">
            <a href="{!! url('admin/order') !!}">
                <span class="glyphicon glyphicon-list-alt"></span> Quản Lý Đơn Hàng
            </a>
        </li>

        <li id='category' class="dropdown">
            <a href="{!! url('admin/category') !!}">
                <span class="glyphicon glyphicon-list"></span> Quản Lý Chuyên Mục
            </a>
        </li>

        <li id='brand' class="dropdown">
            <a href="{!! url('admin/brand') !!}">
                <span class="glyphicon glyphicon-list-alt"></span> Quản Lý Thương Hiệu
            </a>
        </li>

        <li id='brand' class="dropdown">
            <a href="{!! url('admin/slide') !!}">
                <span class="glyphicon glyphicon-cd"></span> Quản Lý Slide
            </a>
        </li>

        <li id='comment' class="dropdown">
            <a href="{!! url('admin/comment') !!}">
                <span class="glyphicon glyphicon-comment"></span> Quản lý bình luận
            </a>
        </li>

        <li id='reports' class="dropdown">
            <a href="{!! url('admin/reports') !!}">
                <span class="glyphicon glyphicon-glyphicon glyphicon-euro"></span> Thống kê
            </a>
        </li>

        <li id='setting' class="dropdown">
            <a href="{!! url('admin/setting') !!}">
                <span class="glyphicon glyphicon-cog"></span> Cài Đặt
            </a>
        </li>
    </ul>
    <hr>
    <div style='text-align: center; line-height: 30px;'>
        <a href='{!! url('admin/user/sua-thong-tin/'.Auth::guard('admin')->User()->id) !!}'>Sửa thông tin cá nhân</a>
        <br>
        <a href='{!! url('/') !!}'>Vào Website</a>
    </div>
</nav>