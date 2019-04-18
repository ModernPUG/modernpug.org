@extends('common.layout')

@section('title', 'Recruiting' )

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/angry-annoyed-cafe-52608.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Recruiting</h3>

                        <p class="mt-50 text-white">
                            PHP와 관련한 채용 공고입니다
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->

    <section class=" section-padding-50">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post recruit">
                        <a href="https://recruit.brich.co.kr/" target="_blank" class="headline">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="/img/recruit/brich_logo.jpg" alt="에어텔닷컴 백엔드 개발자 채용" style="padding:80px 30px;">
                                <!-- category -->
                                <div class="label">Laravel</div>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <h5>워라벨, 라라벨 좋아하는 Modern PHP 개발자 모집</h5>
                                <p>
                                    브리치
                                </p>
                                <p>
                                    Laravel 과 Vue.js 로 개발한 최신 커머스 시스템을 경험해보세요.
                                    브리치 개발팀에 합류하면 그간의 노하우를 전수 받으실 수 있고,
                                    새로운 프로젝트들을 진행하면서 재미있게 개발할 수 있다고 기대하셔도 좋습니다.
                                </p>
                                <!-- Post Meta -->
                                <address>
                                    서울 강남구 봉은사로
                                </address>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection