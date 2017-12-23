<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Cake Shop Online - @yield('title')</title>
    <base href="{{asset('')}}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href='{{asset('css/bootstrap.min.css')}}'>
    <link rel="stylesheet" href='{{asset('css/cloudzoom.css')}}'>
    <link rel="stylesheet" href='{{asset('css/starrr.css')}}'>
    <link rel="stylesheet" href="front-end/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="front-end/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="front-end/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="front-end/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="front-end/assets/dest/css/style.css">
    <link rel="stylesheet" href="front-end/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="css/front-endStyle.css">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/starrr.js') }}"></script>

    <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){
z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='https://v2.zopim.com/?5M6pusidNYQwAtBq6P2Pj1g7Vzw4vSs0';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zendesk Chat Script-->

</head>
<body>
@include('front-end.layouts.header')
<div class="rev-slider">
    @yield('content')
</div> <!-- .container -->
<div id="up_to_top" class="navbar-fixed-bottom">
    <span class="glyphicon glyphicon-circle-arrow-up"></span>
</div>
<div id='add-cart-success' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>Thêm thành công!
            </div>
        </div>
    </div>
</div>
@include('front-end.befor-add-prd')
@include('front-end.layouts.footer')
<!-- include js files -->
<script src="front-end/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="front-end/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="front-end/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="front-end/assets/dest/vendors/animo/Animo.js"></script>
<script src="front-end/assets/dest/vendors/dug/dug.js"></script>
<script src="front-end/assets/dest/js/scripts.min.js"></script>
<script src="front-end/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="front-end/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="front-end/assets/dest/js/waypoints.min.js"></script>
<script src="front-end/assets/dest/js/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>
<script src="{{ asset('js/site.js') }}"></script>
<script src="{{ asset('js/cloudzoom.js') }}"></script>
<!--customjs-->
{{--<script src="front-end/assets/dest/js/custom2.js"></script>--}}

</body>
</html>