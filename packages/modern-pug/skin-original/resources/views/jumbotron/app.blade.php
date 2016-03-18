<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta')
    <meta name="author" content="{{ config('author', 'ModernPUG') }}">
    <meta name="description" content="{{ config('description', 'ModernPUG') }}">
    <meta name="keywords" content="{{ config('keywords', 'ModernPUG,PHP,Q&A,QNA,Wiki,개발자,Developer,알고리즘,프로그래밍,Programming') }}">

    <meta property="og:site_name" content="ModernPUG">
    <meta property="og:image" content="{{ config('og:image', 'http://www.modernpug.org/img/logo.png') }}" />
    <meta property="og:title" content="{{ config('og:title', 'ModernPUG') }}" />
    <meta property="og:description" content="{{ config('og:description', 'ModernPUG') }}" />
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

    <!-- Custom styles for this template -->
    <link href="/vendor/ninecells/assets-twbs3-jbtrn-narrow/css/jumbotron-narrow.css" rel="stylesheet">

    @section('head')
    <link href="/vendor/ninecells/assets-twbs3-jbtrn-narrow/plugins/footer-margin.css" rel="stylesheet">
    @show

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    @section('header')
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation"{!! Request::path() === 'about' ? ' class="active"' : '' !!}>
                <a href="/about">About</a>
                </li>
                <li role="presentation"{!! Request::path() === 'auth/login' || substr(Request::path(), 0, 7) === 'members' ? ' class="active"' : '' !!}>
                @unless(Auth::check())
                <a href="/auth/login">Login</a>
                @else
                <a href="/members/{{ Auth::user()->id }}">My Page</a>
                @endunless
                </li>
            </ul>
        </nav>
        <h3 class="text-muted"><a href="/">ModernPUG</a></h3>
    </div>
    @show

    @yield('content')

    <footer class="footer">
        <p>&copy; 2016 ModernPUG.</p>
    </footer>

</div>
@section('script')
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/vendor/ninecells/assets-twbs3-jbtrn-narrow/js/ie10-viewport-bug-workaround.js"></script>
@show
</body>
</html>
