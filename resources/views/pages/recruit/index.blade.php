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
                        <a href="http://www.jobkorea.co.kr/Recruit/GI_Read/27349638" target="_blank" class="headline">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="/img/recruit/rgb_airtel_logo.png" alt="에어텔닷컴 백엔드 개발자 채용" style="padding:80px 30px;">
                                <!-- category -->
                                <div class="label">상시채용</div>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <h5>신입/경력 PHP백엔드 개발자 채용</h5>
                                <p>
                                    에어텔닷컴
                                </p>
                                <p>
                                    에어텔닷컴은 자유여행 전문 여행사입니다.
                                    PHP를 주력으로 사용하고 있으며 항공권,호텔,티켓,렌트카 등
                                    해외여행과 관련된 시스템 개발을 합니다.
                                </p>
                                <!-- Post Meta -->
                                <address>
                                    서울 중구
                                </address>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection