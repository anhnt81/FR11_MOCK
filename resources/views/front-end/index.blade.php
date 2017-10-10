@extends('front-end.layouts.master')
@section('title')
    Trang Chủ
@endsection
@section('content')
    @include('front-end.slide')
    <div class="container">
        <div class="space60">&nbsp;</div>

        <!-- content -->
        <div id="content" class="space-top-none">
            <div class="main-content">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản Phẩm Mới</h4>

                            <div class="row">
                                <div style='text-align: right'>
                                    <a href='{{route('list-prd')}}'>
                                        Xem tất cả
                                        <span class='glyphicon glyphicon-chevron-right'></span>
                                    </a>
                                </div>
                                @foreach($newProduct as $item)
                                    <div class="col-sm-3" style="margin-top:50px">
                                        <div class="single-item">
                                            @if($item->promotion_price!=0)
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('DetailProduct',$item->id)}}"><img src="images/front-end/product/{{$item->avatar}}" height="250px" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$item->name}}</p>
                                                <p class="single-item-price" style="font-size:16px">
                                                    @if($item->promotion_price==0)
                                                        <span class="flash-sale">{{number_format($item->unit_price)}} đồng</span>
                                                    @else
                                                        <span class="flash-del">{{number_format($item->unit_price)}} đồng</span>
                                                        <span class="flash-sale">{{number_format($item->promotion_price)}} đồng</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('AddToCart',$item->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('DetailProduct',$item->id)}}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản Phẩm Được Quan Tâm</h4>

                            <div style='text-align: right'>
                                <a href='{{route('list-prd')}}'>
                                    Xem tất cả
                                    <span class='glyphicon glyphicon-chevron-right'></span>
                                </a>
                            </div>
                            <div class="row">
                                @foreach($bestProduct as $item)
                                    <div class="col-sm-3" style="margin-top:50px">
                                        <div class="single-item">
                                            @if($item->promotion_price!=0)
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('DetailProduct',$item->id)}}"><img src="images/front-end/product/{{$item->avatar}}" height="250px" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$item->name}}</p>
                                                <p class="single-item-price" style="font-size:16px">
                                                    @if($item->promotion_price==0)
                                                        <span class="flash-sale">{{number_format($item->unit_price)}} đồng</span>
                                                    @else
                                                        <span class="flash-del">{{number_format($item->unit_price)}} đồng</span>
                                                        <span class="flash-sale">{{number_format($item->promotion_price)}} đồng</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('AddToCart',$item->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('DetailProduct',$item->id)}}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->
            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

    <!-- hello! welcome to website modal -->
    <div id='hello-modal' class='modal fade' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h3>Xin chào,</h3>
                </div>

                <div class='modal-body alert-success'>
                    Cảm ơn bạn đã ghé thăm cửa hàng của chúng tôi. Sản phẩm của chúng tôi luôn đảm bảo về chất lượng,
                    nhiều mẫu mã cho bạn thỏa sức lựa chọn với giá cả phải chăng !!!
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            @if(!$old)
            $('#hello-modal').modal('show');
            @endif
        })
    </script>
@endsection