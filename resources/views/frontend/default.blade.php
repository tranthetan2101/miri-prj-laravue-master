<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>@yield('page_title', 'MIRI')</title>
    <meta name="keywords" content="@yield('keywords', 'MIRI')">
    <meta name="author" content="@yield('meta_author', 'MIRI')">

    <meta name="robots" content="@yield('robots', 'index, follow')">
    <meta name="description" content="@yield('description', 'MIRI')">
    <meta property="og:image" content="@yield('og:image', '/images/miri-logo.svg')">
    <meta property="og:title" content="@yield('og:title', 'MIRI')">
    <meta property="og:url" content="@yield('og:url', url()->current())">
    <meta property="og:description" content="@yield('og:description', 'MIRI')">
    <meta property="og:type" content="@yield('og:type', 'website')">
    @yield('meta')

    @stack('before-styles')
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    @stack('after-styles')

    @include('includes.partials.ga')
    @include('includes.partials.fb')
</head>

<body>
    @include('includes.partials.read-only')
{{--    @include('includes.partials.logged-in-as')--}}

    <div id="app">
        <!-- header -->
        <header-component announcement="{{ $announcement ? $announcement->message : '' }}"></header-component>

        <!--content-->
        @section('content')
        @show

        <!--footer-->
        <footer-component facebook="{{ setting('facebook', '') }}" youtube="{{ setting('youtube', '') }}" instagram="{{ setting('instagram', '') }}"></footer-component>
    </div>
    @include('frontend.reload')

    <!--app-->
    <div id="on-cart" class="modal">
        @include('frontend.cart.onCart')
    </div>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '{{ config('boilerplate.fb_app_id') }}',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v9.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @if (!empty(setting('fb_page_id')))
    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="{{setting('fb_page_id')}}">
    </div>
    @endif
    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>


    <script src="{{ asset('js/jquery.flexslider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/price.slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/accordion.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/owl.carousel.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

    @stack('after-scripts')
</body>

</html>
