<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    {{--    @include('website.layouts.head')--}}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Deal Prime - @yield('title')</title>
    @yield('meta')
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Deal Prime">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"  href="{{asset('/')}}admin/assets/images/favicon.png"/>


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:200,300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{asset('website')}}/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('website')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('website')}}/assets/css/price-range/price_range_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />

    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('website')}}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('website')}}/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="{{asset('website')}}/assets/css/style.min.css">
    <!-- Jquery file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="{{asset('website')}}/assets/css/demo35.min.css">

    @yield('style')
</head>
<body>
    <!--<div class="loading-overlay">-->
    <!--    <div class="bounce-loader">-->
    <!--        <div class="bounce1"></div>-->
    <!--        <div class="bounce2"></div>-->
    <!--        <div class="bounce3"></div>-->
    <!--    </div>-->
    <!--</div>-->

    <div class="page-wrapper">
        <!--header start-->
        <header class="header">
           @include('website.layouts.header')
        </header>
        <!-- /header End-->

        <main class="main bg-gray">
            <div id="bodyRes">
                @yield('body')
            </div>
        </main>
        <!-- End .main -->

         <!--Footer  section-->
{{--        <footer class="footer font2 footer-reveal" style="position: initial!important;">--}}
        <footer class="" style="position: initial!important;">
          @include('website.layouts.footer')
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

   @include('website.layouts.mobile-menu')



    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    @include('website.layouts.script')
</body>

</html>
