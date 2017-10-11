@extends('front-end.layouts.master')
@section('title')
    {{$cat->name}}
@endsection
@section('content')
    <div class='container'>
        <div class="beta-products-list">
            <h4>Danh sách sản phẩm thuộc : {{$cat->name}}</h4>
            @if($listProduct->count() > 0)
                @include('front-end.filter')
                <div id='list-product'>
                    @include('front-end.list-prd')
                </div>
            @else
                <b>Không có sản phẩm nào</b>
            @endif
        </div>
    </div>
@endsection