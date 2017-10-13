<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fresh Garden Online Shop - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/adminStyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker3.css') }}">

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</head>

<body>
@include('back-end.common.header')

<!-- The nav-bar on left -->
@include('back-end.common.nav-bar')

<!-- content on right -->
<section class='col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2' id="content">
    <!-- The breadcrumb -->
    <header>
        <ol class="breadcrumb">
            @yield('breadcrumb')
        </ol>
    </header>
    <!-- Main content -->
    <article>
        @yield('content')
    </article>
</section>

<!-- The footer -->
<footer>

</footer>
</body>
</html>