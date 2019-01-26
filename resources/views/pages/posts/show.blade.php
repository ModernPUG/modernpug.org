@extends('common.layout')

<?php
/**
 * @var \App\Post $post
 */
?>

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(/vendor/world/img/blog-img/bg2.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12">
                    <div class="single-blog-title text-center">
                        <!-- category -->
                        <div class="post-cta">
                            @foreach($post->tags as $tag)
                            <a href="#">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <h3>{{ $post->title }}</h3>
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
                            <p>
                                <a target="_blank" href="{{ $post->blog->site_url }}" class="post-author">
                                    @if($post->blog->image_url)
                                        <img src="{{ $post->blog->image_url }}" alt="" style="width:20px;height:20px;border-radius: 5px;">
                                    @endif
                                    {{ $post->blog->title }}
                                </a>
                                on
                                <span class="post-date">{{ $post->published_at }}</span>
                                <a href="{{ $post->link }}" class="btn btn-sm btn-outline-primary pull-right">
                                    <i class="ti-new-window"></i>
                                    원문으로 보기
                                </a>
                            </p>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <p>{!! $post->description !!}</p>
                            <!-- Post Tags -->
                            <ul class="post-tags">
                                @foreach($post->tags as $tag)
                                <li><a href="#">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                            <!-- Post Meta -->
                            <div class="post-meta second-part">
                                <p>
                                    <a target="_blank" href="{{ $post->blog->site_url }}" class="post-author">
                                        @if($post->blog->image_url)
                                            <img src="{{ $post->blog->image_url }}" alt="" style="width:20px;height:20px;border-radius: 5px;">
                                        @endif
                                        {{ $post->blog->title }}
                                    </a>
                                    on
                                    <span class="post-date">{{ $post->published_at }}</span>
                                </p>
                            </div>
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

            <!-- ============== Related Post ============== -->
            <div class="row">

                <?php
                /**
                 * @var \App\Post $relatedPost
                 */
                ?>
                @foreach($relatedPosts as $relatedPost)
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="/vendor/world/img/blog-img/b1.jpg" alt="">
                            <!-- category -->
                            <div class="post-cta"><a href="#">PHP</a></div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="{{ $relatedPost->link }}" class="headline">
                                <h5>{{ $relatedPost->title }}</h5>
                            </a>
                            <p>{!! \App\Services\StripPosts::panel($relatedPost->description) !!}</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a target="_blank" href="{{ $relatedPost->blog->site_url }}" class="post-author">{{ $relatedPost->blog->title }}</a>
                                    on
                                    <span class="post-date">{{ $post->published_at }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
{{--
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="post-a-comment-area mt-70">
                        <h5>Get in Touch</h5>
                        <!-- Contact Form -->
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="name" id="name" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="email" name="email" id="email" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="message" id="message" required></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your comment</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn world-btn">Post comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <!-- Comment Area Start -->
                    <div class="comment_area clearfix mt-70">
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
            --}}
        </div>
    </div>
@endsection