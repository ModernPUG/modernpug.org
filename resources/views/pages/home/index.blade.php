@extends('common.layout')


@section('title_prefix','')


<?php
/**
 * @var \App\Tag $tag
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
                                    <a href="https://www.facebook.com/events/2283126815262130/" target="_blank">
                                        모던PUG 4월 정기 모임 안내
                                    </a>
                                </div>
                            </div>

                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>2</p>
                                </div>
                                <div class="post-title">
                                    <a href="https://www.facebook.com/groups/655071604594451/events/?source=4&action_history=null&filter=calendar" target="_blank">
                                        이달의 행사 안내
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
                                <li class="title">Monthly Best</li>

                                @foreach($monthlyBestByTag as $tag => $posts)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first?"active":"" }}" id="monthly-best-tab-title-{{ $tag }}" data-toggle="tab"
                                       href="#monthly-best-tab-body-{{ $tag }}" role="tab" aria-controls="monthly-best-tab-body-{{ $tag }}" aria-selected="false">{{ $tag }}</a>
                                </li>
                                @endforeach
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                @foreach($monthlyBestByTag as $tag => $posts)
                                    @include('pages.home.partials.tab-body',['tabName'=>'monthly-best-tab-body','tag'=>$tag,'posts'=>$monthlyBestByTag[$tag],'active'=>$loop->first])
                                @endforeach
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
                             * @var \App\Post $post
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


            <div class="row justify-content-center">


                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post post-style-3 mt-50">
                        <img src="/img/index/50663726_10217219035644041_6749344056859426816_o.jpg" alt="2019년 2월 정기모임">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post post-style-3 mt-50">
                        <img src="/img/index/52835872_10217490523671072_6775070197997895680_n.jpg" alt="2019년 3월 정기모임">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post post-style-3 mt-50">
                        <img src="/img/index/201904.jpg" alt="2019년 4월 정기모임">
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection