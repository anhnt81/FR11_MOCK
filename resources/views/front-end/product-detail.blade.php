@extends('front-end.layouts.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản Phẩm {{$product->name}}</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('homePage')}}">Home</a> / <span>Thông Tin Chi Tiết Sản Phẩm</span>
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
                            <img src="images/front-end/product/{{$product->avatar}}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title">
                                <h3>{{$product->name}}</h3></p>
                                <p class="single-item-price" style="font-size:16px">
                                    @if($product->promotion_price==0)
                                        <span class="flash-sale">{{number_format($product->unit_price)}} đồng</span>
                                    @else
                                        <span class="flash-del">{{number_format($product->unit_price)}} đồng</span>
                                        <span class="flash-sale">{{number_format($product->promotion_price)}}
                                            đồng</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-options">
                                <label>Số lượng ( Còn {{$product->qty}} sản phẩm )</label>
                                <div>
                                <input type='text' class="wc-select" name="color" style='width:50px'>
                                <a class="add-to-cart" href="{{route('AddToCart',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                </div>
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
                            <p>{{$product->description}}</p>
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
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{route('DetailProduct',$sp->id)}}"><img
                                                        src="images/front-end/product/{{$sp->avatar}}" alt=""
                                                        height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$sp->name}}</p>
                                            <p class="single-item-price" style="font-size:16px">
                                                @if($sp->promotion_price==0)
                                                    <span class="flash-sale">{{number_format($sp->unit_price)}}
                                                        đồng</span>
                                                @else
                                                    <span class="flash-del">{{number_format($sp->unit_price)}}
                                                        đồng</span>
                                                    <span class="flash-sale">{{number_format($sp->promotion_price)}}
                                                        đồng</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="product.html"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{route('DetailProduct',$sp->id)}}">Details
                                                <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                    @include('front-end.comment')
                </div>
                <div class="col-sm-3 aside">
                    <!-- Products same category -->
                    <div class='panel panel-info'>
                        <div class='panel-heading'><b>Sản phẩm cùng chuyên mục</b></div>
                        <div class='panel-body'>
                            <ul class='list-group'>
                                @foreach($prdSameCat as $item)
                                    <li class="list-group-item" style="height: 150px;text-align: center">
                                        <a href="{{ url('product-detail/'. $item->id) }}"
                                           title="Nhấp vào để đến trang chi tiết">
                                            <img src="{{asset('images/front-end/product/'.$item->avatar)}}"
                                                 style="height: 100px; width: 100%">
                                            {{$item->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Products same brand -->
                    <div class='panel panel-info'>
                        <div class='panel-heading'><b>Sản phẩm cùng thương hiệu</b></div>
                        <div class='panel-body'>
                            <ul class='list-group'>
                                @foreach($prdSameBr as $item)
                                    <li class="list-group-item" style="height: 150px;text-align: center">
                                        <a href="{{ url('product-detail/'. $item->id) }}"
                                           title="Nhấp vào để đến trang chi tiết">
                                            <img src="{{asset('images/front-end/product/'.$item->avatar)}}"
                                                 style="height: 100px; width: 100%">
                                            {{$item->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->


@endsection