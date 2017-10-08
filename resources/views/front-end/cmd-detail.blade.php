<div class='panel panel-default' style='clear:both; margin-top:30px'>
    <div class='panel-heading'>
        <b>Đánh giá trung bình về sản phẩm</b>
    </div>
    <div class='panel-body'>
        <div class='col-xs-12 col-sm-5'>
            <div id='rating-static' class='rating rating-big rate-cmt' rate='{{$rate['avg']}}'></div>
            <div>{{$rate['avg']}} trên 5</div>
        </div>
        <div class='col-xs-12 col-sm-7'>
            <div>5 Sao : {{$rate['five']}} đánh giá</div>
            <div>4 Sao : {{$rate['four']}} đánh giá</div>
            <div>3 Sao : {{$rate['three']}} đánh giá</div>
            <div>2 Sao : {{$rate['two']}} đánh giá</div>
            <div>1 Sao : {{$rate['one']}} đánh giá</div>
        </div>
    </div>
</div>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <b>Tất cả nhận xét</b>
    </div>
    <div class='panel-body'>
        @if($cmt->count() > 0)
            @foreach($cmt as $item)
                <div class="row comment-item">
                    <span class="col-xs-3 col-md-2">
                        <img src="{{asset('uploads/images/' . $item->user->avatar)}}"
                           style="max-width: 80px">
                    </span>
                    <div class="col-xs-9 col-md-10">
                        <p>
                            <b style="color: blue;margin-right: 20px">{{$item->user->name}}</b>
                            <span class='rating rate-cmt' rate='{{$item->rate}}'></span>
                        </p>
                        <p>{{$item->content}}</p>
                        <p>Ngày viết : {{$item->created_at}}</p>
                    </div>
                </div>
            @endforeach
        @else
            <h6>Chưa có bình luận</h6>
        @endif
    </div>
</div>