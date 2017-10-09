<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> Tầng 18, Tóa nhà Handico, Mễ Trì, Hà Nội</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0165 273 5984</a></li>
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
                <a href="index.html" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..."/>
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ Hàng
                            (@if(Session::has('cart')){{Session('cart')->totalQty}}) @else Trống) @endif<i
                                    class="fa fa-chevron-down"></i>
                        </div>
                        <div class="beta-dropdown cart-body">
                            <!-- ktra có giỏ hàng hay không -->
                            @if(Session::has('cart'))
                                @foreach($product_cart as $product)
                                    <div class="cart-item">
                                        <a class="cart-item-delete"
                                           href="{{route('xoa-gio-hang',$product['item']['id'])}}"><i
                                                    class="fa fa-times"></i></a>
                                        <div class="media">
                                            <a class="pull-left" href="">
                                                <img height="50px" width="50px"
                                                      src="images/front-end/product/{{$product['item']['avatar']}}">
                                            </a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{$product['item']['name']}}</span>
                                                <span class="cart-item-amount">{{$product['qty']}}
                                                    *<span>@if($product['item']['promotion_price']==0){{number_format($product['item']['unit_price'])}} @else {{number_format($product['item']['promotion_price'])}}@endif</span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(Session::has('cart'))
                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span
                                                class="cart-total-value">{{Session('cart')->totalPrice}}</span></div>
                                    <div class="clearfix"></div>

                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{route('dat-hang')}}" class="beta-btn primary text-center">Đặt hàng <i
                                                    class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            @endif
                        </div>
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
                        <ul class="sub-menu">
                            @foreach($category as $cat)
                                <li><a href="{{url('chuyen-muc/'.$cat->id)}}">{{$cat->name}}</a>
                                    <ul class="sub-menu">
                                        @foreach($cat->childHas as $submenu)
                                            <li><a href="{{url('chuyen-muc/'.$submenu->id)}}">{{$submenu->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{route('gioi-thieu')}}">Giới thiệu</a></li>
                    <li><a href="{{route('contact')}}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->