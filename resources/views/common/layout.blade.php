<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

@if(config('website.tag_manager'))
    <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ config('website.tag_manager') }}');</script>
        <!-- End Google Tag Manager -->
    @endif

    <title>@yield('title_prefix', config('website.title_prefix', ''))
        @yield('title', config('website.title', ''))
        @yield('title_postfix', config('website.title_postfix', ''))</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="application/opensearchdescription+xml" rel="search" href="{{ asset('opensearch.xml') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta.description',config('website.meta.description',''))"/>
    <meta name="keywords" content="@yield('meta.keywords',config('website.meta.keywords',''))"/>
    <meta name="author" content="@yield('meta.author',config('website.meta.author',''))"/>
    <link rel="canonical" href="@yield('canonical',url()->current())"/>
    <meta property="og:locale" content="{{ app()->getLocale() }}"/>
    <meta property="og:title" content="@yield('meta.title',config('website.title',''))"/>
    <meta property="og:description" content="@yield('meta.description',config('website.meta.description',''))"/>
    <meta property="og:site_name" content="@yield('meta.site_name',config('website.meta.og.site_name',''))"/>
    <meta property="og:url" content="@yield('canonical',url()->current())"/>
    <meta property="og:type" content="@yield('meta.type',config('website.meta.og.type',''))"/>
    <meta property="og:image" content="@yield('meta.image',config('website.meta.og.image',''))"/>
    <!-- Favicon  -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/vendor/world/style.css">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    @yield('css')
    @stack('css')
</head>

<body>

<!-- ***** Header Area Start ***** -->
<header class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <!-- Logo -->
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="/img/logo/logo_white.svg" style="width:150px;" alt="Logo">
                    </a>
                    <!-- Navbar Toggler -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav"
                            aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <!-- Navbar -->
                    <div class="collapse navbar-collapse" id="worldNav">
                        @include('common.gnb')
                        <!-- Search Form  -->
                        <div id="search-wrapper">
                            <form action="{{ route('posts.search') }}">
                                <input type="search" name="keyword" id="search" placeholder="Search something...">
                                <div id="close-icon"></div>
                                <input class="d-none" type="submit" value="">
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

@section('content')
@show

<!-- ***** Footer Area Start ***** -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 mb-50">
                <div class="footer-single-widget">
                    <a href="/">
                        <img src="/img/logo/logo_white.svg" style="width:250px;" alt="Logo">
                    </a>
                    <div class="copywrite-text mt-30">
                        <p>
                            홈페이지와 관련된 내용은
                            <a class="text-info" href="{{ config('modernpug.facebook') }}" target="_blank">페이스북 그룹</a>,
                            <a class="text-info" href="{{ config('modernpug.slack') }}" target="_blank">슬랙</a>,
                            <a class="text-info" href="{{ config('modernpug.github_repo') }}" target="_blank">깃허브</a>
                            를 통해서 문의바랍니다
                        </p>
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;{{ date('Y') }} All rights reserved | This template is made with
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            by
                            <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-50">
                <div class="footer-single-widget">
                    <h5>
                        Invite ModernPUG Slack
                        <i class="fa fa-slack"></i>
                    </h5>
                    <form action="{{ route('slack.store') }}" method="post" onclick="document.location.href=this.attributes.action.value;">
                        <input type="email" name="email" placeholder="Join Us" required>
                        <button type="button"><i class="fa fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ***** Footer Area End ***** -->


<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="/vendor/world/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="/vendor/world/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="/vendor/world/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="/vendor/world/js/plugins.js"></script>
<!-- Active js -->
<script src="/vendor/world/js/active.js"></script>
<script src="{{ mix('js/custom.js') }}"></script>
@env(['local','testing'])
    <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/metrics.js"></script>
@endenv

@include('common.toastr')

@yield('js')
@stack('js')
</body>

</html>
