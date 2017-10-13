    <div class="row">
        @foreach($listProduct as $item)
            <div class="col-xs-6 col-sm-3" style="margin-top:50px">
                <div class="single-item">
                    @if($item->promotion_price!=0)
                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                    @endif
                    <div class="single-item-header">
                        <a href=""><img src="images/front-end/product/{{$item->avatar}}" height="250px" alt=""></a>
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
<div style="text-align: center">
    {!! $listProduct->links() !!}
</div>