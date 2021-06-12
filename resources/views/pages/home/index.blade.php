@extends('common.layout')


@section('title_prefix','')


<?php
/**
 * @var \App\Models\WeeklyBest $latestWeeklyBest
 */
?>
@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area">

        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel">
            <!-- Single Slide -->
            <div class=" height-400 single-hero-slide bg-img background-overlay"
                 style="background-image: url(/img/laptop-3190194_1920.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="single-blog-title text-center">
                                <h5 class="text-white">현대적인 PHP 개발에 관심 많은 개발자를 위한 개발자들의 비영리 사용자 모임입니다.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Slide -->
            <div class=" height-400 single-hero-slide bg-img background-overlay"
                 style="background-image: url(/img/company-concept-creative-7369.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="single-blog-title text-center">
                                <h5 class="text-white">매월 1회 정기 모임과 발표를 통해 관심사와 지식을 공유합니다.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Post Slide -->
        <div class="hero-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-post-slide">

                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>1</p>
                                </div>
                                <div class="post-title">
                                    <a href="{{ config('modernpug.facebook') }}" target="_blank">
                                        <i class="fa fa-facebook-square"></i>
                                        모던 PUG 공식 페이스북
                                    </a>
                                </div>
                            </div>

                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>2</p>
                                </div>
                                <div class="post-title">
                                    <a href="{{ route('slack.index') }}">
                                        <i class="fa fa-slack"></i>
                                        모던 PUG 슬랙
                                    </a>
                                </div>
                            </div>

                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>3</p>
                                </div>
                                <div class="post-title">
                                    <a href="{{ config('modernpug.youtube') }}" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                        모던 PUG 공식 유튜브 채널
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-50">
                        <!-- category Area -->
                        <div class="world-category-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">
                                    {{ $latestWeeklyBest->year }}년
                                    {{ $latestWeeklyBest->week_no }}주차 주간 인기글
                                    <a class="title" href="{{ route('posts.weekly') }}">
                                        <small>더보기</small>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">


                                <div class="row">
                                    <div class="col-12 col-md-6">

                                        @foreach($latestWeeklyBest->posts as $post)
                                            @if(!$loop->first)
                                                @continue
                                            @endif

                                            @include('partials.blog',['post'=>$post])
                                        @endforeach
                                    </div>

                                    <div class="col-12 col-md-6">


                                        @foreach($latestWeeklyBest->posts as $post)
                                            @if($loop->first)
                                                @continue
                                            @endif

                                            @if($loop->iteration > 7)
                                                @continue
                                            @endif

                                            @include('partials.blog-2-non-body',['post'=>$post])
                                        @endforeach


                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                    <!-- Load More btn -->
                    <div class="row">
                        <div class="col-12">
                            <div class="load-more-btn mb-50 text-center">
                                <a href="{{ route('posts.weekly') }}" class="btn world-btn">Read More</a>
                            </div>
                        </div>
                    </div>


                    <div class="world-latest-posts">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="title">
                                    <h5>Latest Posts</h5>
                                </div>

                                <?php
                                /**
                                 * @var \App\Models\Post $post
                                 */
                                ?>
                                @foreach($latestPosts as $post)
                                    @include('partials.blog-2',['post'=>$post])
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Load More btn -->
                    <div class="row">
                        <div class="col-12">
                            <div class="load-more-btn mt-50 mb-50 text-center">
                                <a href="{{ route('posts.search') }}" class="btn world-btn">Read More</a>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="post-sidebar-area">

                        @include('widget.about')
                        @include('widget.connect')

                        {{--@include('widget.editor-pick')--}}

                        @include('widget.banner')
                        @include('widget.sponsor')
                        @include('widget.tags')


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
