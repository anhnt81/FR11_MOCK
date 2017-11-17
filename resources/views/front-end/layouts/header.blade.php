<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> Tầng 18, Tóa nhà Handico, Mễ Trì, Hà Nội</a></li>
                    <li><a href=""><i class="fa fa-phone"></i>0988886789</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::check())
                        <li>
                            <a>
                                <img src="{{asset('uploads/images/'.Auth::user()->avatar)}}"
                                     class="img-responsive img-circle"
                                     style="max-width: 35px;float: left;margin-right: 15px;margin-top: 7px;">
                                {{Auth::user()->name}}
                            </a>
                        </li>
                        <li>
                            <a href="{{url('sua-thong-tin')}}">
                                <span class="glyphicon glyphicon-user"></span> Thông tin cá nhân
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('dang-xuat') }}">
                                <span class="glyphicon glyphicon-log-out"></span> Đăng xuất
                            </a>
                        </li>
                    @else
                        <li><a href="{{route('dang-ky')}}">Đăng kí</a></li>
                        <li><a href="{{route('dang-nhap')}}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="" id="logo"><img src="front-end/assets/dest/images/logo-cake.jpg" width="520px" height="80px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{ route('search')}}">
                        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..."/>
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart"  id='cart-modal'>
                        @include('front-end.cart')
                    </div> <!-- .cart -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span>
                <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('homePage')}}">Trang Chủ</a></li>

                    <li><a href="#">Loại Sản Phẩm</a>
                        @php
                        \App\Http\Helper\Helper::multiMenu($allCat);
                        @endphp
                        {{--<ul class="sub-menu">--}}
                            {{--@foreach($category as $cat)--}}
                                {{--<li><a href="{{url('chuyen-muc/'.$cat->id)}}">{{$cat->name}}</a>--}}
                                    {{--<ul class="sub-menu">--}}
                                        {{--@foreach($cat->childHas as $submenu)--}}
                                            {{--<li><a href="{{url('chuyen-muc/'.$submenu->id)}}">{{$submenu->name}}</a></li>--}}
                                        {{--@endforeach--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    </li>
                    <li><a href="{{route('gioi-thieu')}}">Giới thiệu</a></li>
                    <li><a href="{{route('contact')}}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->