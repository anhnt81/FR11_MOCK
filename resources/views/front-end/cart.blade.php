<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ Hàng
    (@if(Session::has('cart')){{Session('cart')->totalQty}}) @else Trống) @endif<i
            class="fa fa-chevron-down"></i>
</div>
<div class="beta-dropdown cart-body">@if(Session::has('cart'))
        @foreach($product_cart as $product)
            <div class="cart-item">
                <a class="cart-item-delete"
                   href="{{route('removeSigleCart',$product['item']['id'])}}"><i
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
                <a href="{{route('removeAllCart')}}" class="beta-btn primary text-center">Xóa giỏ hàng <i
                            class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    @endif
</div>