@extends('back-end.layouts.master')
@section('content')
    <div class="form-group col-md-3 col-md-offset-3">
    </div>
    <form class="navbar-form navbar-left" role="search" method="get" id="searchform" action="{{route('search.user')}}">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="key">
        </div>
        <button type="submit" class="btn btn-default" style="margin-top:5px">Tìm Kiếm</button>
    </form>
    <form action="{{route('create.product')}}" id="demo-form2" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12">Full name</label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" id="fullname" class="form-control col-md-7 col-xs-12" name="fullname">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" id="email" name="email"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12">Password</label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" id="password" name="password"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12">Repassword</label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" id="re_password" name="re_password"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12" >Address</label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" id="address" name="address"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5 col-sm-3 col-xs-12" >Phone</label>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <input type="text" id="phone" name="phone"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            @foreach($errors->all() as $error)
                <div class="col-md-6"></div>
                <div class="form-group">
                    <p style="color:red">{{$error}}</p>
                </div>
            @endforeach
            @if(Session::has('message'))
                <div class="col-md-6"></div>
                <p style="color:red">{{Session::get('message')}}</p>
            @endif
            <div class="col-md-6"></div>
            <button class="btn btn-success" type="submit">Add User</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
    </form>
@endsection