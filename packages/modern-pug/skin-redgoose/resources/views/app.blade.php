<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta')
    <meta name="author" content="{{ config('author', 'ModernPUG') }}">
    <meta name="description" content="{{ config('description', 'ModernPUG') }}">
    <meta name="keywords"
          content="{{ config('keywords', 'ModernPUG,PHP,Q&A,QNA,Wiki,개발자,Developer,알고리즘,프로그래밍,Programming') }}">
    <meta property="og:site_name" content="ModernPUG">
    <meta property="og:image" content="{{ config('og:image', 'http://www.modernpug.org/img/logo.png') }}"/>
    <meta property="og:title" content="{{ config('og:title', 'ModernPUG') }}"/>
    <meta property="og:description" content="{{ config('og:description', 'ModernPUG') }}"/>
    @show
    <link rel="icon" href="/favicon.ico">
    <title>
        @section('title')
        {{ config('title', 'ModernPUG') }}
        @show
    </title>
    <!-- Bootstrap core CSS -->
    <link href="/vendor/ninecells/assets-twbs3/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/vendor/ninecells/assets-twbs3-jbtrn-narrow/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/fonts.pkgd.css">
    <link rel="stylesheet" href="/css/app.pkgd.css">
    @yield('head')
</head>
<body>
<main>

    @section('header')
    <header class="header">
        <nav class="top-bar">
            <div class="container">
                <ul>
                    @unless(Auth::check())
                    <li><a href="/auth/login"><i class="lnr lnr-enter"></i><span>login</span></a></li>
                    <li><a href="/auth/login"><i class="lnr lnr-paw"></i><span>join</span></a></li>
                    @else
                    <li><a class="btn logout" href="#" data-href="/auth/logout"><i class="lnr lnr-exit"></i><span>logout</span></a></li>
                    <li><a href="/members/{{ Auth::user()->id }}"><i class="lnr lnr-user"></i><span>mypage</span></a></li>
                    @endunless
                    <li class="search-bar">
                        <a ><i class="lnr lnr-magnifier"></i><span>search</span></a>
                        <div>
                            <form action="#" class="keyword-search">
                                <fieldset>
                                    <legend class="blind">keyword search form</legend>
                                    <input type="text" name="" maxlength="20" placeholder="keyword" />
                                    <button type="submit"><i class="lnr lnr-chevron-right"></i></button>
                                </fieldset>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="body container">
            <h1><a href="/"><img src="/img/img-logo.png" width="183" alt="@yield('title')"></a></h1>
            <nav class="navigation">
                <ul>
                    <li role="presentation"{!! Request::path() === 'about' ? ' class="active"' : '' !!}>
                    <a href="/about">About</a>
                    </li>
                    <li role="presentation"{!! Request::path() === 'qs' ? ' class="active"' : '' !!}>
                    <a href="https://wiki.modernpug.org/questions">Q&amp;A</a>
                    </li>
                    <li role="presentation"{!! Request::path() === 'wiki' ? ' class="active"' : '' !!}>
                    <a href="/wiki">PugWiki</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    @show

    <div class="container contents">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <p class="copyright">&copy; 2016 ModernPUG.</p>
        </div>
    </footer>

</main>

@section('script')
<script src="/js/vendor.pkgd.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // toggle search form
    $('.header .search-bar a').on('click', function () {
        var $li = $(this).parent();
        $li.toggleClass('active');
        if ($li.hasClass('active')) {
            $li.find('input[type=text]').focus();
        }
    });
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/vendor/ninecells/assets-twbs3-jbtrn-narrow/js/ie10-viewport-bug-workaround.js"></script>
@show
</body>
</html>
