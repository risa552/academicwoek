<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard One | Notika - Notika Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.css">
    <link rel="stylesheet" href="/assets/css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/notika-custom-icon.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/wave/waves.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="/assets/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
<!-- titlebar --> @include('titlebar')

                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
   
    <!-- Main Menu area start-->
    @include('menu')
    <!-- Main Menu area End-->
    @yield('content')
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 
. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
    <script src="/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="/assets/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="/assets/js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="/assets/js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="/assets/js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="/assets/js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="/assets/js/counterup/jquery.counterup.min.js"></script>
    <script src="/assets/js/counterup/waypoints.min.js"></script>
    <script src="/assets/js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="/assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- jvectormap JS
		============================================ -->
    <script src="/assets/js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/assets/js/jvectormap/jvectormap-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="/assets/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="/assets/js/sparkline/sparkline-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="/assets/js/flot/jquery.flot.js"></script>
    <script src="/assets/js/flot/jquery.flot.resize.js"></script>
    <script src="/assets/js/flot/curvedLines.js"></script>
    <script src="/assets/js/flot/flot-active.js"></script>
    <!-- knob JS
		============================================ -->
    <script src="/assets/js/knob/jquery.knob.js"></script>
    <script src="/assets/js/knob/jquery.appear.js"></script>
    <script src="/assets/js/knob/knob-active.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="/assets/js/wave/waves.min.js"></script>
    <script src="/assets/js/wave/wave-active.js"></script>
    <!--  todo JS
		============================================ -->
    <script src="/assets/js/todo/jquery.todo.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="/assets/js/plugins.js"></script>
	<!--  Chat JS
		============================================ -->
    <script src="/assets/js/chat/moment.min.js"></script>
    <script src="/assets/js/chat/jquery.chat.js"></script>
    <!-- main JS
		============================================ -->
    <script src="/assets/js/main.js"></script>
	<!-- tawk chat JS
		============================================ -->
    <script src="/assets/js/tawk-chat.js"></script>
</body>

</html>