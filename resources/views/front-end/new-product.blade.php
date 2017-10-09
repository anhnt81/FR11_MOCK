@extends('front-end.layouts.master')
@section('title')
    {{$cat->name}}
@endsection
@section('content')
    <div class="beta-products-list">
        <h4>Sản phẩm mới</h4>
        @include('front-end.filter')
        @include('front-end.list-prd')
    </div>
@endsection