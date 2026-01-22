<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Deal Prime - @yield('title')</title>

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

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('website')}}/assets/css/demo35.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('website')}}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('website')}}/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">


    {{-- <link rel="stylesheet" href="{{asset('website')}}/assets/css/style.min.css"> --}}
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
        <footer class=" " style="position: initial!important;">
          @include('website.layouts.footer')
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

   @include('website.layouts.mobile-menu')


    <!--News letter popup-->
   <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url({{asset('website')}}/assets/images/newsletter_popup_bg.jpg)">
        <div class="newsletter-popup-content">
            <img src="{{asset('website')}}/assets/images/logo-black.png" alt="Logo" class="logo-newsletter" width="111" height="44">
            <h2>Subscribe to newsletter</h2>

            <p>
                Subscribe to the Porto mailing list to receive updates on new arrivals, special offers and our promotions.
            </p>

            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Your email address" required />
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                    <label for="show-again" class="custom-control-label">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div>
        <!-- End .newsletter-popup-content -->

        <button title="Close (Esc)" type="button" class="mfp-close">
            ×
        </button>
    </div>
    <!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    @include('website.layouts.script')
</body>

</html>
