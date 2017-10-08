@extends('back-end.layouts.layout-admin')

@section('title')
    Thông kê kinh doanh
@endsection

@section('breadcrumb')
    <li><a href="{!! url('admin') !!}">Trang chủ</a></li>
    <li>Thống kê</li>
@endsection

@section('content')
    <header style='text-align: center;' class='col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3'>
        <form action='admin/report'>
            <div class='form-group col-xs-9'>
                <input class='form-control form-val datepicker' name='fromDate' style='width:45%;float:left'>
                <div style='width:10%;text-align: center;float:left;'> - </div>
                <input class='form-control form-val datepicker' name='toDate' style='width:45%'>
            </div>
            <div class='form-group col-xs-3'>
                <button type='button' id='btn-filter' class='btn btn-primary'>Lọc</button>
            </div>
        </form>
    </header>
    <div id='list-data' style='clear:both;'>
        @include('back-end.reports.content')
    </div>
@endsection