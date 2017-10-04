@extends('front-end.layouts.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản Phẩm {{$sanpham->name}}</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('trang-chu')}}">Home</a> / <span>Thông Tin Chi Tiết Sản Phẩm</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{$sanpham->image}}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title"><h3>{{$sanpham->name}}</h3></p>
                                <p class="single-item-price" style="font-size:16px">
                                    @if($sanpham->promotion_price==0)
                                        <span class="flash-sale">{{number_format($sanpham->unit_price)}} đồng</span>
                                    @else
                                        <span class="flash-del">{{number_format($sanpham->unit_price)}} đồng</span>
                                        <span class="flash-sale">{{number_format($sanpham->promotion_price)}} đồng</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$sanpham->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <p>Số Lượng:</p>
                            <div class="single-item-options">
                                <select class="wc-select" name="color">
                                    <option>Số Lượng</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description"><h3>Mô Tả</h3></a></li>
                        </ul>
                        <div class="panel" id="tab-description">
                            <p>{{$sanpham->description}}</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản Phẩm Cùng Loại</h4>
                        <div class="row">
                            @foreach($sp_tuongtu as $sp)
                                <div class="col-sm-4">
                                    <div class="single-item" style="margin-top:20px">
                                        @if($sp->promotion_price!=0)
                                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{route('sanpham',$sp->id)}}"><img src="{{$sp->image}}" alt="" height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$sp->name}}</p>
                                            <p class="single-item-price" style="font-size:16px">
                                                @if($sp->promotion_price==0)
                                                    <span class="flash-sale">{{number_format($sp->unit_price)}} đồng</span>
                                                @else
                                                    <span class="flash-del">{{number_format($sp->unit_price)}} đồng</span>
                                                    <span class="flash-sale">{{number_format($sp->promotion_price)}} đồng</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{route('sanpham',$sp->id)}}">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">{{$sp_tuongtu->links()}}</div>
                    </div> <!-- .beta-products-list -->
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Dự Báo Thời Tiết</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img src="source/image/nang.jpg" alt=""></a>
                                    <div class="media-body">
                                        Quận Thanh Xuân
                                        <p class="beta-sales-price" style="font-size: 16px">25-34 độ</p>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img src="source/image/nang.jpg" alt=""></a>
                                    <div class="media-body">
                                        Quận Cầu Giấy
                                        <p class="beta-sales-price" style="font-size: 16px">25-34 độ</p>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img src="source/image/mua.png" alt=""></a>
                                    <div class="media-body">
                                        Quận Long Biên
                                        <p class="beta-sales-price" style="font-size: 16px">25-34 độ</p>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img src="source/image/nang.jpg" alt=""></a>
                                    <div class="media-body">
                                        Quận Đống Đa
                                        <p class="beta-sales-price" style="font-size: 16px">25-34 độ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">Âm Nhạc Thư Giãn</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <div class="media-body">
                                        <embed  src="https://www.youtube.com/embed/Llw9Q6akRo4" frameborder="0" allowfullscreen style="border:red 1px solid"  width=”420″ height=”315″></embed>
                                    </div>
                                    <div class="media-body">
                                        <embed  src="https://www.youtube.com/embed/FN7ALfpGxiI" frameborder="0" allowfullscreen style="border:red 1px solid"  width=”420″ height=”315″></embed>
                                    </div>
                                    <div class="media-body">
                                        <embed  src="https://www.youtube.com/embed/Vk8_0QaJr3I" frameborder="0" allowfullscreen style="border:red 1px solid"  width=”420″ height=”315″></embed>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection