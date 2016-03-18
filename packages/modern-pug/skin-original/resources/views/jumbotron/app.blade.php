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
<link href="/vendor/ninecells/assets-twbs3-jbtrn-narrow/plugins/footer-margin.css" rel="stylesheet">
@endsection

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
@endsection
