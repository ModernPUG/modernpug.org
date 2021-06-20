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
                        <h3>PHP 유저들에게 자신의 블로그를 알려주세요</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-12 col-lg-12 ubuntu-fonts">

                    <h3 class="mb-2">
                        <a href="{{ route('blogs.create') }}" class="btn btn-outline-primary pull-right">블로그 등록하기</a>
                        모던 PHP 유저그룹에 블로그를 등록해보세요!
                    </h3>
                    <h6 class="mb-50">매일 신규 등록된 글과 주간 인기글을 PHP유저 그룹에게 발송해드립니다!</h6>


                    <div class="row">
                        @foreach($blogs as $blog)

                            <div class="col-md-6 col-lg-4 col-xl-3 mb-30">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img
                                            src="{{ $blog->image_url??"/img/adult-article-assortment-1496183.jpg" }}"
                                            alt="{{ $blog->title }}">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content" style="word-break: break-all">
                                        <h5>{{ $blog->title }}</h5>
                                        <div class="mt-2" data-toggle="tooltip" data-placement="bottom" title="최종 수정일">
                                            <i class="fa fa-clock-o"></i>
                                            {{ $blog->updated_at }}
                                        </div>


                                        <div class="badge badge-info badge-pill">
                                            게시글 : {{ number_format($blog->posts_count) }}개
                                        </div>


                                        <div class="mt-2">
                                            {{ $blog->description }}
                                        </div>
                                        <div class="mt-2">

                                            <a href="{{ $blog->site_url }}" target="_blank"
                                               class="btn btn-sm btn-outline-primary w-100">

                                                <i class="fa fa-external-link"></i>
                                                블로그 바로가기
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
