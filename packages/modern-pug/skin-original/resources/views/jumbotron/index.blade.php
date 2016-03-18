@extends('ncells::jumbotron.app')

@section('content')
<style>
    .jumbotron {
        position: relative;
        background-image: url("/img/modernpug.png");
    }

    .jumbotron .mask {
        background-color: #ffffff;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        opacity: 0.8;
    }

    .jumbotron .slogan {
        position: relative;
    }
</style>

<div class="jumbotron">
    <div class="mask"></div>
    <div class="slogan">
        <h1>ModernPUG</h1>
        @unless(Auth::check())
        <p><a class="btn btn-lg btn-success" href="/auth/login" role="button">입장하기</a></p>
        @endunless
    </div>
</div>

<div class="row marketing">
    <div class="col-lg-6">
        <h4><a href="/wiki">PugWiki</a></h4>
        <p>각종 PHP 읽을거리를 작성해둔 곳.</p>

        <h4><a href="/qs">Q&A</a></h4>
        <p>웹 개발에 관련된 다양한 문제에 대하여 질문하세요.</p>

        <h4><a href="http://allblog.modernpug.org">Allblog</a></h4>
        <p>한국 PHP 블로거들의 포스트를 모아보는 곳.</p>
    </div>

    <div class="col-lg-6">
        <h4><a href="https://www.facebook.com/groups/655071604594451/">ModernPUG 페이스북 그룹</a></h4>
        <p>Modern Php User Group 입니다.</p>

        <h4><a href="http://slack-invite.modernpug.org/">ModernPUG 슬랙 초대받기</a></h4>
        <p>ModernPUG 회원을 위한 채팅공간 입니다.</p>
    </div>
</div>

@endsection
