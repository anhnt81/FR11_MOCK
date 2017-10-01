<div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-paw"></i> <span>Manage Admin</span></a>
          </div>
          <div class="clearfix"></div>
          <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('public/uploads/images/'. Auth::user()->avatar )}}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <!-- <h2>{{Auth::User()->username}}</h2> -->
            </div>
        </div>
        <br />
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{url('admin')}}">
                            <i class="fa fa-home"></i> Trang chủ
                        </a>
                    </li><li>
                        <a href="">
                            <i class="fa fa-user"></i> Quản Lý Tài Khoản
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-user"></i> Quản Lý Khách Hàng
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/list-product') }}">
                            <i class="fa fa-product-hunt"></i>Quản Lý Sản Phẩm
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-table"></i> Chuyên Mục và Hãng Sản Phẩm
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-desktop"></i> Quản Lý Đơn Hàng
                        </a>
                    </li>       
                    <li>
                    <a href="">
                            <i class="fa fa-desktop"></i> Quản lý Bình Luận
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>