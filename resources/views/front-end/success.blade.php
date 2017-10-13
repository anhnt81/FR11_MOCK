@extends('front-end.layouts.master')

@section('title')
    Đặt hàng
@endsection
@section('content')
<div class='col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3'
     style='border: 2px gray solid; border-radius: 5px; padding: 20px 40px; margin-top:100px;margin-bottom:100px'>
    <h4>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</h4>
    <div style='margin-top:40px; text-align: center'>
        <a href='{{route('homePage')}}' class='btn btn-primary'>
            <span class='glyphicon glyphicon-share-alt'></span> Click vào đây để tiếp tục mua hàng
        </a>
    </div>
</div>
    @endsection