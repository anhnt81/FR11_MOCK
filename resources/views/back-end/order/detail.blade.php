@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý đơn hàng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/order') !!}">Đơn hàng</a></li>
    <li>Chi tiết đơn hàng</li>
@endsection

@section('content')
    <!-- customer info -->
    <div class='panel panel-info col-xs-12 col-md-4 order-info'>
        <div class='panel-heading'>
            <h3 class='panel-title'>Thông tin khách hàng</h3>
        </div>

        <div class='panel-body'>
            <div>
                <span>Họ tên</span>
                <span class='right'>{!! $cus->name !!}</span>
            </div>

            <div>
                <span>Số điện thoại</span>
                <span class='right'>{!! $cus->phone !!}</span>
            </div>

            <div>
                <span>Địa chỉ mail</span>
                <span class='right'>{!! $cus->email !!}</span>
            </div>

            <div>
                <span>Giới tính</span>
                <span class='right'>{!! $cus->s_gender !!}</span>
            </div>
        </div>
    </div>

    <div class='panel panel-info col-xs-12 col-md-7 col-md-offset-1 order-info'>
        <div class='panel-heading'>
            <h3 class='panel-title'>Đơn hàng</h3>
        </div>

        <div class='panel-body'>
            <div>
                <span>Ngày tạo</span>
                <span class='right'>{!! $order->created_at !!}</span>
            </div>

            <div>
                <span>Tổng tiền</span>
                <span class='right'>{!! $order->total !!}</span>
            </div>

            <div>
                <span>Tình trạng đơn hàng</span>
                <span class='right'>{!! $order->s_status !!}</span>
            </div>

            <div>
                <span>Ghi chú</span>
                <span class='right'>{!! $order->note !!}</span>
            </div>
        </div>
    </div>

    <div id='detail-info' class='panel panel-info' style='clear:both;'>
        <div class='panel-heading'>
            <h3 class='panel-title'>Chi tiết đơn hàng</h3>
        </div>

        <div class='panel-body table-responsive'>
            <table class='table table-hover table-striped'>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh đại diện</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div>
        <a href='admin/order' class='btn btn-warning'>Quay lại</a>
    </div>
@endsection
