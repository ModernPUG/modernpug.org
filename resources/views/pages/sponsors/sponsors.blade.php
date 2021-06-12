@extends('common.layout')

@section('title', '스폰서 안내' )

@push('css')
    <style>
        .single-blog-post {
            margin: 15px 0;
        }
    </style>
@endpush

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/agreement-business-businessmen-886465.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Sponsors</h3>

                        <p class="mt-50 text-white">
                            Modern PHP User Group의 공식 후원사입니다
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->



    <section class="section-padding-50">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-12 col-lg-12">

                    <h4>정기 모임 후원</h4>
                    <div class="row">

                        <div class="col-md-3">
                            <a href="http://imicorp.co.kr/" target="_blank" class="headline">
                                <div class="single-blog-post">
                                    <div class="post-thumbnail">
                                        <img src="/img/sponsors/imi.jpg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>(주)아이엠아이</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="https://www.jetbrains.com/" target="_blank" class="headline">
                                <div class="single-blog-post">
                                    <div class="post-thumbnail">
                                        <img src="/img/sponsors/logo_JetBrains_4.svg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>Jetbrains</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="https://www.wisen.co.kr/" target="_blank" class="headline">
                                <div class="single-blog-post">
                                    <div class="post-thumbnail">
                                        <img src="/img/sponsors/gsneotek.jpeg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>GS 네오텍</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-md-3">
                            <a href="https://www.xpressengine.com/" target="_blank" class="headline">
                                <div class="single-blog-post">
                                    <div class="post-thumbnail">
                                        <img src="/img/sponsors/XE_banner_350.jpg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>Xpress Engine</h5>
                                    </div>
                                </div>
                            </a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
