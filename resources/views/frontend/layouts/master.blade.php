<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ \Illuminate\Support\Facades\Session::get(\App\Helpers\BaseHelper::LANG_SESSION_NAME) }}">

<head>
    <title>AD Group</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/front-end/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/css/animate.css') }} ">

    <link rel="stylesheet" href="{{ asset('/front-end/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('/front-end/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('/front-end/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

    <link rel="stylesheet" href="{{ asset('/front-end/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/css/jquery.timepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('/front-end/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/css/style.css') }}">
</head>

<body class="goto-here">
@include('frontend.layouts.header')
@yield('content')
@include('frontend.layouts.footer')
</body>

<script src="{{ asset('/front-end/js/jquery.min.js') }}"></script>
<script src="{{ asset('/front-end/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('/front-end/js/popper.min.js') }}"></script>
<script src="{{ asset('/front-end/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/front-end/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('/front-end/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/front-end/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('/front-end/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/front-end/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/front-end/js/aos.js') }}"></script>
<script src="{{ asset('/front-end/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('/front-end/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/front-end/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
</script>
<script src="{{ asset('/front-end/js/google-map.js') }}"></script>
<script src="{{ asset('/front-end/js/main.js') }}"></script>
<script src="{{ asset('/front-end/js/custom.js') }}"></script>
</html>