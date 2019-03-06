@extends('common.layout')

@section('title', 'Releases')

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

                    <div class="post-content-area mb-100">
                        <!-- category Area -->
                        <div class="world-category-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">Release</li>

                                @foreach ($types as $type)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="release-tab-title-{{ $type }}" data-toggle="tab" href="#release-tab-body-{{ $type }}"
                                        role="tab" aria-controls="release-tab-body-{{ $type }}" aria-selected="false">{{
                                        $type }}</a>
                                </li>
                                @endforeach
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                @foreach ($types as $type)
                                    <div class="tab-pane {{ $loop->first ? 'active show' : 'fade' }}" id="release-tab-body-{{ $type }}" role="tabpanel">
                                        @foreach ($releases as $index => $release)
                                            @if ($release->type == $type || $type == 'All')
                                                <!-- Single Blog Post -->
                                                <div class="single-blog-post post-style-2 d-flex align-items-center article">
                                                    <!-- Post Thumbnail -->
                                                    <div class="post-thumbnail">
                                                        <img src="{{ asset('img/release/' . $release->type . '.png') }}" alt="">
                                                    </div>
                                                    <!-- Post Content -->
                                                    <div class="post-content">
                                                        <a href="{{ $release->site_url }}" target="_blank" class="headline">
                                                            <h5>{{ $release->version }}</h5>
                                                        </a>
                                                        <div class="post-meta">
                                                            <p>
                                                                release on
                                                                <span class="post-date">{{ $release->released_at->format('Y-m-d') }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">
                        @include('widget.recently-release-news', ['releases' => $recentlyReleases])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
