@extends('front-end.layouts.master')

@section('title')
    Đăng Nhập
@endsection

@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng nhập</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="index.html">Home</a>/<span>Đăng nhập</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <form action="{{route('login')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-3"></div>
                @if(Session::has('flag'))
                    <div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
                    <div class="col-sm-3"></div>
                @endif
                <div class="col-sm-6">
                    <h4>Đăng nhập</h4>
                    <div class="space20">&nbsp;</div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >Email</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" >Password</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <button type="submit" class="btn btn-warning">Reset</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

