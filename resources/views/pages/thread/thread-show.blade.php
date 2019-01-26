@extends('common.layout')

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(/vendor/world/img/blog-img/bg2.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <!-- category -->
                        <div class="post-cta"><a href="#">PHP</a></div>
                        <h3>쓰레드가 열렸을 경우 어떤 주제로 쓰레드가 열렸는지 타이틀을 입력받는다</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area ============= -->
                <div class="col-12 col-lg-8">
                    <div class="single-blog-content mb-100">
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <p><a href="#" class="post-author">웹으로 말하기</a> on <a href="#" class="post-date">2018-11-11</a></p>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">

                            <div class="row">

                                <div class="col-12 col-lg-12">
                                    <!-- Comment Area Start -->
                                    <div class="comment_area clearfix">
                                        <ol>
                                            <!-- Single Comment Area -->
                                            <li class="single_comment_area">
                                                <!-- Comment Content -->
                                                <div class="comment-content">
                                                    <!-- Comment Meta -->
                                                    <div class="comment-meta d-flex align-items-center justify-content-between">
                                                        <p><a href="#" class="post-author">웹으로 말하기</a> on <a href="#" class="post-date">2018-11-11</a></p>
                                                        <a href="#" class="comment-reply btn world-btn">Reply</a>
                                                    </div>
                                                    <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                                </div>
                                                <ol class="children">
                                                    <li class="single_comment_area">
                                                        <!-- Comment Content -->
                                                        <div class="comment-content">
                                                            <!-- Comment Meta -->
                                                            <div class="comment-meta d-flex align-items-center justify-content-between">
                                                                <p><a href="#" class="post-author">웹으로 말하기</a> on <a href="#" class="post-date">2018-11-11</a></p>
                                                                <a href="#" class="comment-reply btn world-btn">Reply</a>
                                                            </div>
                                                            <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>

                                            <!-- Single Comment Area -->
                                            <li class="single_comment_area">
                                                <!-- Comment Content -->
                                                <div class="comment-content">
                                                    <!-- Comment Meta -->
                                                    <div class="comment-meta d-flex align-items-center justify-content-between">
                                                        <p><a href="#" class="post-author">웹으로 말하기</a> on <a href="#" class="post-date">2018-11-11</a></p>
                                                        <a href="#" class="comment-reply btn world-btn">Reply</a>
                                                    </div>
                                                    <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                                </div>
                                            </li>

                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- Post Tags -->
                            <ul class="post-tags">
                                <li><a href="#">Manual</a></li>
                                <li><a href="#">Liberty</a></li>
                                <li><a href="#">Recommendations</a></li>
                                <li><a href="#">Interpritation</a></li>
                            </ul>

                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area mb-100">

                        @include('widget.about')
                        @include('widget.connect')
                        @include('widget.banner')
                        @include('widget.sponsor')
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection