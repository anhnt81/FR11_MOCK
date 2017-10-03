@extends('back-end.layouts.layout-admin')

@section('title')
    Quản lý đơn hàng
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li><a href="{!! url('admin/order') !!}">Đơn hàng</a></li>
    <li>Sửa thông tin</li>
@endsection

@section('content')
    <!-- main content -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa thông tin đơn hàng</h3>
        </div>
        <div class="panel-body">
            <form method="post" role="form">
                {{ csrf_field() }}
                <div class='modal-body'>
                    <div class='form-group'>
                        <label for='change-status'>Tình trạng đơn hàng</label>
                        <select name='status' id='change-status' class='form-control'>
                            @foreach($status as $key => $value)
                                <option value='{!! $key !!}'
                                @if($order->status == $key) selected @endif>{!! $value !!}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for='note'>Ghi chú</label>
                        <textarea name='note' id='note' class='form-control'>
                        {!! $order->note !!}
                    </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Lưu</button>
                    <a href="{!! url('admin/order') !!}" class="btn btn-danger">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
