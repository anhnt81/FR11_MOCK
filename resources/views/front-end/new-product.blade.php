@extends('front-end.layouts.master')
@section('title')
    <h4>Danh Sách Sản Phẩm</h4>
@endsection
@section('content')
    <div class="beta-products-list">
        <div class="container">
            <h4 style="margin-top: 20px;">Danh Sách Sản phẩm</h4>
            @include('front-end.filter')
            <div id='list-product'>
                @include('front-end.list-prd')
            </div>
        </div>
    </div>
@endsection