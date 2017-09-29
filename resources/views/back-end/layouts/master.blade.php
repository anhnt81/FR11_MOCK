<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      
    <title>@yield('title')</title>
  <!-- Bootstrap -->
  <link href="{{asset('admin-master/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('admin-master/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="{{asset('admin-master/build/css/custom.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/adminStyle.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <!-- vứt đoạn này menu-->
      @include('back-end.layouts.menu')

      <!-- top navigation --><!-- header -->
      @include('back-end.layouts.header')
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
       @yield('content')
      </div>
      <!-- /page content -->

      <!-- footer content -->
      @include('back-end.layouts.footer')
      <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{asset('js/admin-master/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('js/admin-master/bootstrap/dist/js/bootstrap.min.js')}}"></script>

  

    <script src="{{asset('admin-master/build/js/custom.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </body>
</html>
