<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Deal Prime - @yield('title')</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    @if ($setting->favicon)
        <link rel="icon" type="image/x-icon" href="{{asset($setting->favicon)}}">
    @else
        <link rel="icon" type="image/x-icon" href="{{asset('website')}}/assets/images/icons/favicon.png">
    @endif
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


