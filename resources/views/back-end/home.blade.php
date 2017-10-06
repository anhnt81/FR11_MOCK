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
                        <div class="large">{{$dayOrder}}</div>
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
                        <div class="large">{{$weekOrder}}</div>
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
                        <div class="large">{{$totalOrder}}</div>
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
                        <div class="large">{{$closeOrder}}</div>
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
                    <div class="canvas-wrapper">
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

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script>
        var randomScalingFactor = function () {
            return Math.round(Math.random() * 1000)
        };

        var lineChartData = {
            labels: ["Ngày 1", "Ngày 2", "Ngày 3", "Ngày 4", "Ngày 5", "Ngày 6", "Ngày 7"],
            datasets: [
                {
                    label: "7 days dataset",
                    fillColor: "rgba(48, 164, 255, 0.2)",
                    strokeColor: "rgba(48, 164, 255, 1)",
                    pointColor: "rgba(48, 164, 255, 1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(48, 164, 255, 1)",
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                }
            ]

        }

        var chart = document.getElementById("week-chart").getContext("2d");
        new Chart(chart).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    </script>
@endsection
