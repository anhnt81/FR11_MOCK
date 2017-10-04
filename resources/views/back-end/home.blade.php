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
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <span class='glyphicon glyphicon-user'></span>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Đơn hàng mới </div>
                        <div class="text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <span class='glyphicon glyphicon-gift'></span>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Sản phẩm</div>
                        <div class="text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <span></span>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"></div>
                        <div class="text-muted">Sản phẩm</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <span class='glyphicon glyphicon-list-alt'></span>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Tổng đơn hàng</div>
                        <div class="text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
@endsection
