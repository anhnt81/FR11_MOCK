<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Shop Online - @yield('title')</title>
    <base href="{{asset('')}}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/front-endStyle.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <link rel="stylesheet" href="images/front-end/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="images/front-end/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="images/front-end/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="images/front-end/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="images/front-end/assets/dest/css/style.css">
    <link rel="stylesheet" href="images/front-end/assets/dest/css/animate.css">
</head>
<body>
@include('front-end.layouts.header')
<div class="rev-slider">
    @yield('content')
</div> <!-- .container -->
@include('front-end.layouts.footer')
<!-- include js files -->
<script src="images/front-end/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="images/front-end/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="images/front-end/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="images/front-end/assets/dest/vendors/animo/Animo.js"></script>
<script src="images/front-end/assets/dest/vendors/dug/dug.js"></script>
<script src="images/front-end/assets/dest/js/scripts.min.js"></script>
<script src="images/front-end/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="images/front-end/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="images/front-end/assets/dest/js/waypoints.min.js"></script>
<script src="images/front-end/assets/dest/js/wow.min.js"></script>
<!--customjs-->
<script src="images/front-end/assets/dest/js/custom2.js"></script>
<script>
    $(document).ready(function($) {
        $(window).scroll(function(){
            if($(this).scrollTop()>150){
                $(".header-bottom").addClass('fixNav')
            }else{
                $(".header-bottom").removeClass('fixNav')
            }}
        )
    })
</script>
</body>
</html>