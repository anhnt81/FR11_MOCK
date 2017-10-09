@extends('front-end.layouts.master')

@section('title')
    Đặt hàng
@endsection
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đặt hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <form action="{{route('dat-hang')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    @if(Session::has('thongbao')){{Session::get('thongbao')}}
                    @endif
                    <div class="col-sm-6">
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" placeholder="Họ tên" name="name" required>
                        </div>
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>

                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" required placeholder="expample@gmail.com" name="email">
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" id="adress" placeholder="Street Address" name="address" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                <div class="your-order-item">
                                    @if(Session::has('cart'))
                                        @foreach($product_cart as $cart)
                                            <div>
                                                <!--  one item	 -->
                                                <div class="media">
                                                    <img width="25%" src="{{$cart['item']['image']}}" alt="" class="pull-left">
                                                    <div class="media-body">
                                                        <p class="font-large"></p>
                                                        <span class="color-gray your-order-info">{{$cart['item']['name']}}</span>
                                                        <span class="color-gray your-order-info">Số Lượng: <input style="width: 40px;height: 25px;text-align: center" type="number" name="so_luong" value="{{$cart['qty']}}"></span>
                                                        <span class="color-gray your-order-info">Đơn Giá: {{$cart['price']}}</span>
                                                    </div>
                                                </div>
                                                <!-- end one item -->
                                            </div>
                                        @endforeach
                                    @endif
                                        <a href="{{route('dat-hang')}}" class="beta-btn primary text-center">Lưu lại <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    @if(Session::has('cart'))
                                    @foreach($product_cart as $product)
                                        @php
                                            $totalPrice += $product['price'];
                                        @endphp
                                    @endforeach
                                    @else
                                        @php
                                            $totalPrice += 0;
                                        @endphp
                                    @endif
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                    <div class="pull-right"><h5 class="color-black"> {{number_format($totalPrice)}} đồng</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                        </div>
                                    </li>
                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>- Số tài khoản: 123 456 789
                                            <br>- Chủ TK: Nguyễn A
                                            <br>- Ngân hàng ACB, Chi nhánh TPHCM
                                        </div>
                                    </li>

                                </ul>
                            </div>

                            <div class="text-center"><button type="submit" class="beta-btn primary" href="#">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

    <!--customjs-->

@endsection