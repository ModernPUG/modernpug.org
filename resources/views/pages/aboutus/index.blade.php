@extends('common.layout')

@section('title', 'About Us' )

@push('css')
    <style>
        .single-blog-post{margin:15px 0;}
        .single-blog-post .post-content{padding:10px 20px;}
    </style>
@endpush

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/book-computer-design-326424.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Modern PHP User Group</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="regular-page-wrap section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="page-content">
                        <h5>
                            현대적인 PHP 개발에 관심 많은 개발자를 위한 개발자들의 비영리 사용자 모임입니다.<br />
                            매월 1회 정기 모임과 발표를 통해 관심사와 지식을 공유합니다.
                        </h5>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-12 col-lg-12">
                    <h4>Facilitators</h4>

                    <div class="row">




                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Blog Post -->
                            <div class="single-blog-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail" style="width:70%; margin:auto;padding:5px;">
                                    <img src="https://avatars0.githubusercontent.com/u/4939813?s=240&u=58731a92d08b1d365ff3571277716bdf67f12b61&v=4"
                                         alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content text-center">
                                    <h5>KKAME

                                        <a style="font-size:inherit" class="text-primary" target="_blank" href="//github.com/kkame">
                                            <i class="fa fa-github"></i>
                                        </a>
                                        <a style="font-size:inherit" class="text-primary" target="_blank" href="//kkame.net">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </h5>

                                    <div style="font-size:14px;">
                                        <i class="fa fa-tag"></i>
                                        공식 홈페이지를 담당합니다
                                    </div>
                                    <div style="font-size:14px;">
                                        <i class="fa fa-commenting"></i>
                                        개발 못합니다. 컴퓨터 못고쳐요. 프린터 못잡아요.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Blog Post -->
                            <div class="single-blog-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail" style="width:70%; margin:auto;padding:5px;">
                                    <img src="https://avatars1.githubusercontent.com/u/6157033?s=400&u=206f028c798e95e17c787270585f8cf7e1e4491e&v=4"
                                         alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content text-center">
                                    <h5>이현석

                                        <a style="font-size:inherit" class="text-info" target="_blank" href="//github.com/smartbos">
                                            <i class="fa fa-github"></i>
                                        </a>
                                        <a style="font-size:inherit" class="text-info" target="_blank" href="//leehyunseok.com">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </h5>

                                    <div style="font-size:14px;">
                                        <i class="fa fa-tag"></i>
                                        정모 공지를 올립니다.
                                    </div>
                                    <div style="font-size:14px;">
                                        <i class="fa fa-commenting"></i>
                                        자영업자입니다. 책도 씁니다.
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-12 col-lg-12">
                    <h4>Projects</h4>

                    <div class="row">


                        <div class="single-blog-post post-style-4 d-flex align-items-center" style="width:100%">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="{{ asset('img/logo/logo-01.png') }}" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{ config('modernpug.facebook') }}" class="headline">
                                    <h5>정기 유저 모임</h5>
                                </a>
                                <p>
                                    매월 첫째주 수요일에 정기 모임이 개최됩니다.
                                    일정 안내는 <a class="text-info" href="{{ config('modernpug.facebook') }}">페이스북</a>을 통해 공개되며
                                    2~3가지 주제를 가지고 간단한 발표가 진행됩니다.
                                    발표 이후에은 네트워킹 타임이 있으며
                                    발표한 자료는 <a class="text-info" href="{{ config('modernpug.meetup_repo') }}">깃허브</a>를 통해 공개됩니다.
                                </p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p>
                                        안내공지 : @smartbos,
                                        행사진행 : @a2,
                                        자료정리 : @youngiggy
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="single-blog-post post-style-4 d-flex align-items-center" style="width:100%">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="{{ asset('img/logo/logo-01.png') }}" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{ config('modernpug.github_repo') }}" class="headline">
                                    <h5>홈페이지 / 주간 인기글 알림</h5>
                                </a>
                                <p>
                                    PHP 관련 블로그의 내용을 모아서 보여주며 매주 월요일 주간 인기글에 대해 슬랙으로 알림을 보내줍니다.
                                    그 외에 PHP 관련 릴리즈 소식을 모아서 보여줍니다.
                                </p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p>
                                        관리 : @kkame
                                    </p>
                                </div>
                            </div>
                        </div>



                        <div class="single-blog-post post-style-4 d-flex align-items-center" style="width:100%">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="{{ asset('img/logo/logo-01.png') }}" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="https://wiki.modernpug.org/" class="headline">
                                    <h5>QNA / WIKI</h5>
                                </a>
                                <p>
                                    PHP와 관련된 QNA 및 WIKI를 제공합니다
                                </p>
                            </div>
                        </div>

                        <div class="single-blog-post post-style-4 d-flex align-items-center" style="width:100%">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="{{ asset('img/logo/logo-01.png') }}" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="http://modernpug.github.io/php-the-right-way/" class="headline">
                                    <h5>PHP The Right Way</h5>
                                </a>
                                <p>
                                    <a class="text-info" href="https://github.com/codeguy/php-the-right-way">PHP The Right Way</a>의 한글 번역을 제공합니다
                                </p>
                            </div>
                        </div>

                        <div class="single-blog-post post-style-4 d-flex align-items-center" style="width:100%">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="{{ asset('img/logo/logo-01.png') }}" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="https://designpatternsphpko.readthedocs.io" class="headline">
                                    <h5>Design Patterns PHP</h5>
                                </a>
                                <p>
                                    <a class="text-info" href="https://github.com/domnikl/DesignPatternsPHP">Design Patterns PHP</a>의 한글 번역을 제공합니다
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
