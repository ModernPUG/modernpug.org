@extends('common.layout')

@section('title', '메타 블로그' )

@php
/**
 * @var \App\Models\Blog[]|\Illuminate\Database\Eloquent\Collection $myBlogs
 * @var \App\Models\Blog[]|\Illuminate\Database\Eloquent\Collection $blogs
 */
@endphp

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/author-blog-businesswoman-267569.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>메타블로그에 참가중인 블로그들입니다</h3>
                        <a class="btn btn-outline-primary mt-50" href="{{ route('blogs.create') }}">Register blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <section class="contact-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-12 col-lg-12 ubuntu-fonts">

                    <div class="row">
                        @foreach($blogs as $blog)

                            <div class="col-md-3 mb-30">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post">
                                    <a href="{{ $blog->site_url }}" target="_blank" class="headline">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="{{ $blog->image_url??"/img/adult-article-assortment-1496183.jpg" }}"
                                                 alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content" style="word-break: break-all">
                                            <h5>{{ $blog->title }}</h5>
                                            <div>
                                                {{ $blog->description }}
                                            </div>
                                            <div>
                                                {{ $blog->site_url }}
                                                <i class="fa fa-external-link"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
