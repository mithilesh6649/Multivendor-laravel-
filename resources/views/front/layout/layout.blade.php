<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Laravel Multi Vendor E-commerce Template - By Stack Developers Youtube Channel</title>
    <!-- Standard Favicon -->
    <link href="favicon.ico" rel="shortcut icon">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{asset('front/css/fontawesome.min.css')}}">
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="{{asset('front/css/ionicons.min.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('front/css/animate.min.css')}}">
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="{{asset('front/css/jquery-ui-range-slider.min.css')}}">
    <!-- Utility -->
    <link rel="stylesheet" href="{{asset('front/css/utility.css')}}">
    <!-- Main -->
    <link rel="stylesheet" href="{{asset('front/css/bundle.css')}}">
</head>

<body>

<!-- app -->
<div id="app">
    <!-- Header -->
      @include('front.layout.header')
    <!-- Header /- -->
      
      @yield('content')

    <!-- Footer -->
      @include('front.layout.footer')
    <!-- Footer /- -->
     @include('front.layout.modals')
</div>
<!-- app /- -->
<!--[if lte IE 9]>
<div class="app-issue">
    <div class="vertical-center">
        <div class="text-center">
            <h1>You are using an outdated browser.</h1>
            <span>This web app is not compatible with following browser. Please upgrade your browser to improve your security and experience.</span>
        </div>
    </div>
</div>
<style> #app {
    display: none;
} </style>
<![endif]-->
<!-- NoScript -->
<noscript>
    <div class="app-issue">
        <div class="vertical-center">
            <div class="text-center">
                <h1>JavaScript is disabled in your browser.</h1>
                <span>Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
            </div>
        </div>
    </div>
    <style>
    #app {
        display: none;
    }
    </style>
</noscript>
<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
window.ga = function() {
    ga.q.push(arguments)
};
ga.q = [];
ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<!-- Modernizr-JS -->
<script type="text/javascript" src="{{asset('front/js/vendor/modernizr-custom.min.js')}}"></script>
<!-- NProgress -->
<script type="text/javascript" src="{{asset('front/js/nprogress.min.js')}}"></script>
<!-- jQuery -->
<script type="text/javascript" src="{{asset('front/js/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="{{asset('front/js/bootstrap.min.js')}}"></script>
<!-- Popper -->
<script type="text/javascript" src="{{asset('front/js/popper.min.js')}}"></script>
<!-- ScrollUp -->
<script type="text/javascript" src="{{asset('front/js/jquery.scrollUp.min.js')}}"></script>
<!-- Elevate Zoom -->
<script type="text/javascript" src="{{asset('front/js/jquery.elevatezoom.min.js')}}"></script>
<!-- jquery-ui-range-slider -->
<script type="text/javascript" src="{{asset('front/js/jquery-ui.range-slider.min.js')}}"></script>
<!-- jQuery Slim-Scroll -->
<script type="text/javascript" src="{{asset('front/js/jquery.slimscroll.min.js')}}"></script>
<!-- jQuery Resize-Select -->
<script type="text/javascript" src="{{asset('front/js/jquery.resize-select.min.js')}}"></script>
<!-- jQuery Custom Mega Menu -->
<script type="text/javascript" src="{{asset('front/js/jquery.custom-megamenu.min.js')}}"></script>
<!-- jQuery Countdown -->
<script type="text/javascript" src="{{asset('front/js/jquery.custom-countdown.min.js')}}"></script>
<!-- Owl Carousel -->
<script type="text/javascript" src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<!-- Main -->
<script type="text/javascript" src="{{asset('front/js/app.js')}}"></script>
</body>
</html>
