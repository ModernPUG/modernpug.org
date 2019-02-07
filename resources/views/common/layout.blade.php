<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_prefix', config('app.name', ''))</title>

    <!-- Favicon  -->
    <link rel="icon" href="/vendor/world/img/core-img/favicon.ico">

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
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="/img/img-logo.png" style="filter:brightness(500%);width:150px;" alt="Logo"></a>
                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Navbar -->
                        <div class="collapse navbar-collapse" id="worldNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
                                </li>


                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarBlogDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Meta Blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarBlogDropdown">
                                        <a class="dropdown-item" href="{{ route('blogs.index') }}">Blog</a>
                                        <a class="dropdown-item" href="{{ route('posts.index') }}">Post</a>
                                        <a class="dropdown-item" href="{{ route('posts.search') }}">Search</a>
                                        <a class="dropdown-item" href="{{ route('tags.index') }}">Tag</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Links
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="https://wiki.modernpug.org/questions" target="_blank">
                                            QNA & WIKI
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                        <a class="dropdown-item" href="http://modernpug.github.io/php-the-right-way/" target="_blank">
                                            PHP The Right Way
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                        <a class="dropdown-item" href="https://designpatternsphpko.readthedocs.io/ko/latest/" target="_blank">
                                            Design Patterns PHP
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                        <a class="dropdown-item" href="https://github.com/ModernPUG/meetup" target="_blank">
                                            정기모임 발표자료
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('news.release.index') }}">Releases</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recruit.index') }}">Recruit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sponsors.index') }}">Sponsors</a>
                                </li>


                                @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ auth()->user()->name }}님 환영합니다
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    </div>
                                </li>
                                @endauth
                                @guest
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Login / Register
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                        </div>
                                    </li>
                                @endguest

                            </ul>
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
                <div class="col-12 col-md-8">
                    <div class="footer-single-widget">
                        <a href="/"><img src="/img/img-logo.png" style="filter:brightness(500%);width:150px;" alt="Logo"></a>
                        <div class="copywrite-text mt-30">
                            <p>홈페이지와 관련된 내용은 페이스북 그룹, 슬랙, 깃허브를 통해서 문의바랍니다</p>
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;{{ date('Y') }} All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="footer-single-widget">
                        <h5>
                            Invite ModernPUG Slack
                            <i class="fa fa-slack"></i>
                        </h5>
                        <form action="{{ route('slack.store') }}" method="post">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your mail" required>
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
    @include('common.toastr')

    @yield('js')
</body>

</html>
