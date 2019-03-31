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
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/agreement-business-businessmen-886465.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Sponsors</h3>
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

                    <h4>정기 스폰서</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <a href="http://imicorp.co.kr/" target="_blank" class="headline">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="/img/sponsors/imi.jpg" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <h5>(주)아이엠아이</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="https://www.jetbrains.com/" target="_blank" class="headline">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="/img/sponsors/logo_JetBrains_4.svg" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <h5>Jetbrains</h5>
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
