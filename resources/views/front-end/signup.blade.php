@extends('front-end.layouts.master')

@section('title')
Đăng kí
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng kí</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="index.html">Home</a> / <span>Đăng kí</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <form action="{{route('dang-ki')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('dangkithanhcong'))
                        <div class="alert alert-success">{{Session::get('dangkithanhcong')}}</div>@endif
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Email</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Full Name</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="fullname" name="fullname"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Address</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="address"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Phone</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" id="phone" name="phone"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Password</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="password" id="password" name="password"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Repassword</label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="password" id="re_password" name="re_password"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection