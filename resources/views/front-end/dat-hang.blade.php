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
            <form id='checkout-frm' action="{{route('dat-hang')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    @if(Session::has('thongbao')){{Session::get('thongbao')}}
                    @endif
                    <div class="col-sm-6">
                        <div class="space20">&nbsp;</div>

                        <div class="form-group">
                            <label for="name">Họ tên*</label>
                            <input class='form-control' type="text" id="name" placeholder="Họ tên" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Giới tính </label>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="1" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="2" style="width: 10%"><span style="margin-right: 10%">Nữ</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="3" style="width: 10%"><span>Khác</span>

                        </div>

                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input class='form-control' type="email" id="email" required placeholder="expample@gmail.com" name="email">
                        </div>

                        <div class="form-group">
                            <label for="adress">Địa chỉ*</label>
                            <input class='form-control' type="text" id="address" placeholder="Street Address" name="address" required>
                        </div>


                        <div class="form-group">
                            <label for="phone">Điện thoại*</label>
                            <input class='form-control' type="text" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Ghi chú</label>
                            <textarea class='form-control' id="notes" name="note"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                <div class="your-order-item">
                                    @if(Session::has('cart'))
                                        @foreach($product_cart as $key => $cart)
                                            <div>
                                                <!--  one item	 -->
                                                <div class="media checkout-prd">
                                                    <img src="{{asset('images/front-end/product/'.explode(',', $cart['item']['images'])[0])}}" class="pull-left">
                                                    <div class="media-body">
                                                        <div >
                                                            <p class="font-large"></p>
                                                            <span class="color-gray your-order-info">{{$cart['item']['name']}}</span>
                                                            <span class="color-gray your-order-info">Số Lượng:
                                                            <input class='input-number checkout-qty' maxval='{{$cart['total_qty']}}'
                                                                   style="width: 40px;height: 25px;text-align: center" type="number" name="qty" value="{{$cart['qty']}}">
                                                        </span>
                                                            <span class="color-gray your-order-info">Đơn Giá: {{$cart['aprice']}}</span>
                                                        </div>
                                                        <div >
                                                            <button type='button' class='btn btn-default update-cart' pid='{{$key}}' qty='{{$cart['qty']}}'>
                                                                <span class='glyphicon glyphicon-refresh'></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end one item -->
                                            </div>
                                        @endforeach
                                    @endif
                                        {{--<button id='save-cart' class="beta-btn primary text-center">Lưu lại <i class="fa fa-chevron-right"></i></button>--}}
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
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

                            <div class="text-center">
                                @if(Auth::check())
                                    <input name='uid' type='hidden' value='{{Auth::User()->id}}'>
                                    <button type="submit" class="beta-btn primary" href="{{}}">
                                        Đặt hàng <i class="fa fa-chevron-right"></i>
                                    </button>
                                @endif
                            </div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

    <!--customjs-->
    <script>
        $(document).ready(function () {
            $('.update-cart').click(function () {
                var input = $(this).parent().parent().find('input[name="qty"]')[0];
                var pid = $(this).attr('pid');
                var qty = $(input).val();

                if(qty != $(this).attr('qty')) {
                    $.ajax({
                        url: 'sua-gio-hang/' + pid + '/' + qty,
                        success: function (responce) {
                            if(responce == 'ok') {
                                window.location = $(location).attr('href');
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
            });
            $('#checkout-frm').submit(function () {
                $('.err').remove();

                var name = $('#name').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var email = $('#email').val();
                var err = 0;

                if(name.length < 2) {
                    $('#name').before("<div class='alert alert-danger err'>Tên khách phải lớn hơn 2 ký tự</div>");
                    err = 1;
                }
                if(!/(^01[0-9]{9}$)|(^0(9|8)[0-9]{8}$)/.test(phone)) {
                    $('#phone').before("<div class='alert alert-danger err'>Số điện thoại không hợp lệ</div>");
                    err = 1;
                }
                if(address.length <= 5) {
                    $('#address').before("<div class='alert alert-danger err'>Hãy ghi địa chỉ giao hàng cụ thể</div>");
                    err = 1;
                }
                if(!/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email)) {
                    $('#email').before("<div class='alert alert-danger err'>E-mail không hợp lệ</div>");
                    err = 1;
                }

                if(err == 0) {
                    return true;
                }

                return false;
            });
        });
    </script>
@endsection