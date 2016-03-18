@extends('ncells::jumbotron.main')

@section('meta')
<meta name="author" content="{{ config('author', 'ModernPUG') }}">
<meta name="description" content="{{ config('description', 'ModernPUG') }}">
<meta name="keywords" content="{{ config('keywords', 'ModernPUG,PHP,Q&A,QNA,Wiki,개발자,Developer,알고리즘,프로그래밍,Programming') }}">

<meta property="og:site_name" content="ModernPUG">
<meta property="og:image" content="{{ config('og:image', 'http://www.modernpug.org/img/logo.png') }}" />
<meta property="og:title" content="{{ config('og:title', 'ModernPUG') }}" />
<meta property="og:description" content="{{ config('og:description', 'ModernPUG') }}" />
@endsection

@section('title')
{{ config('title', 'ModernPUG') }}
@endsection

@section('site-name', 'ModernPUG')

@section('head')
@endsection

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
					<a href="/qs">Q&amp;A</a>
				</li>
				<li role="presentation"{!! Request::path() === 'wiki' ? ' class="active"' : '' !!}>
					<a href="/wiki">PugWiki</a>
				</li>
			</ul>
		</nav>
	</div>
</header>
@endsection

@section('footer')
<footer class="footer">
	<div class="container">
		<p class="copyright">&copy; 2016 @yield('site-name').</p>
	</div>
</footer>
@endsection