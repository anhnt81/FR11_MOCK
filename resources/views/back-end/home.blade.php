@extends('back-end.layouts.layout-admin')
@section('title')
    Trang chủ
@endsection

@section('breadcrumb')
    <li>Trang chủ</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget ">
                <div class="param">
                    <div class="col-xs-5 col-sm-3 col-lg-5" style='background-color: #54fff6;'>
                        <span class='glyphicon glyphicon-list-alt icon-home'></span>
                    </div>
                    <div class="col-xs-7 col-sm-9 col-lg-7">
                        <div class="text-muted">Đơn hàng trong ngày</div>
                        <div class="large">{{$orders['day']}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget ">
                <div class="param">
                    <div class="col-xs-5 col-sm-3 col-lg-5" style='background-color: #fffb6e'>
                        <span class='glyphicon glyphicon-list-alt icon-home'></span>
                    </div>
                    <div class="col-xs-7 col-sm-9 col-lg-7">
                        <div class="text-muted">Đơn hàng trong tuần</div>
                        <div class="large">{{$orders['week']}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="param">
                    <div class="col-xs-5 col-sm-3 col-lg-5" style='background-color: #6eff5c'>
                        <span class='glyphicon glyphicon-list-alt icon-home'></span>
                    </div>
                    <div class="col-xs-7 col-sm-9 col-lg-7">
                        <div class="text-muted">Tổng đơn hàng</div>
                        <div class="large">{{$orders['total']}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="param">
                    <div class="col-xs-5 col-sm-3 col-lg-5" style='background-color: #ff6e65'>
                        <span class='glyphicon glyphicon-list-alt icon-home'></span>
                    </div>
                    <div class="col-xs-7 col-sm-9 col-lg-7">
                        <div class="text-muted">Tổng đơn bị hủy</div>
                        <div class="large">{{$orders['close']}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tổng quan cửa hàng trong tuần</div>
                <div class="panel-body">
                    <div class="chart-container" style="position: relative;">
                        <canvas class="main-chart" id="week-chart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Thông báo</div>
                <div class="panel-body">
                    @if (count($orders['pending']) > 0)
                        <h4>Các đơn hàng đang chờ xử lý</h4>
                        <div class='ntf-home'>
                        @foreach ($orders['pending'] as $item)
                             - #{{$item['id']}}<br>
                        @endforeach
                        </div>
                    @endif

                    @if (count($prd) > 0)
                         <h4>Các sản phẩm sắp hết hàng</h4>
                        <div class='ntf-home'>
                         @foreach ($prd as $item)
                                - #{{$item['id']}} : {{$item['name']}} : {{$item['qty']}} sản phẩm.<br>
                         @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'admin/date',
                dataType:'json',
                success: function (responce) {
                    console.log(responce);
                    setChart(responce['date'], responce['value']);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        })
    </script>
@endsection
