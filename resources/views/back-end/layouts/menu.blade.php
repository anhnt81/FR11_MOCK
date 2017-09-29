<div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-paw"></i> <span>Manage Admin</span></a>
          </div>
          <div class="clearfix"></div>
          <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('gentelella-master/production/images/img.jpg')}}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <!-- <h2>{{Auth::User()->full_name}}</h2> -->
            </div>
        </div>
        <br />
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="">
                            <i class="fa fa-home"></i> Quản Lý Tài Khoản
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-edit"></i>Quản Lý Type Product
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-table"></i> Quản Lý Mặt Hàng
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-desktop"></i> Quản Lý Đơn Hàng
                        </a>
                    </li>       
                    <li>
                    <a href="">
                            <i class="fa fa-desktop"></i> Đơn Hàng Chưa Thanh Toán
                        </a>
                    </li>    
                    <li>
                    <a href="">
                            <i class="fa fa-desktop"></i> Đơn Hàng Đã Thanh Toán
                        </a>
                    </li>   
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>