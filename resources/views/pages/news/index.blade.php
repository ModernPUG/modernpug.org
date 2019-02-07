@extends('common.layout')

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(/img/Programming-Wallpapers-33-2880-x-1800.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Releases</h3>
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
                    
                    @foreach ($datas['types'] as $type)
                    <div class="post-content-area mb-100">
                        <!-- category Area -->
                        <div class="world-category-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">{{ $type }}</li>

                                @foreach ($datas['releases'] as $index => $release)
                                    @if ($release->type === $type)
                                    <li class="nav-item">
                                        <a class="nav-link" id="release-tab-body-{{ $index }}" data-toggle="tab" href="#release-tab-body-{{ $index }}"
                                            role="tab" aria-controls="release-tab-body-{{ $index }}" aria-selected="false">{{ $release->version }}</a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach($datas['releases'] as $index => $release)
                                    @if ($release->type === $type)
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-2 d-flex align-items-center article">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <a href="" target="_blank" class="headline">
                                                <img src="" alt="">
                                            </a>
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="" target="_blank" class="headline">
                                                <h5>{{ $release->version }}</h5>
                                                <p>{{ substr($release->content, 0, 180) }}</p>
                                            </a>
                                            <!-- Post Meta -->
                                            {{-- <div class="post-meta">
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
                                            </div> --}}
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                    
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">

                        {{-- @include('widget.about')
                        @include('widget.connect')
                        @include('widget.banner')
                        @include('widget.sponsor') --}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
