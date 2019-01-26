@extends('common.layout')

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(/img/blog-blogger-blogging-4458.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12">
                    <div class="single-blog-title text-center">
                        <form action="{{ route('posts.search') }}">

                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-10 col-lg-10" style="background-color: white">
                                        <form class="card card-sm">
                                            <div class="card-body row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <i class="fa fa-search h4 text-body"></i>
                                                </div>
                                                <!--end of col-->
                                                <div class="col">
                                                    <input class="form-control form-control-lg form-control-borderless" name="keyword" value="{{ $keyword??'' }}"
                                                           type="search" placeholder="Search topics or keywords">
                                                </div>
                                                <!--end of col-->
                                                <div class="col-auto">
                                                    <button class="btn btn-lg btn-primary" type="submit">Search</button>
                                                </div>
                                                <!--end of col-->
                                            </div>
                                        </form>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </div>
                        </form>
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
                                <li class="title">Weekly Best</li>

                                @foreach($weeklyBestByTag as $tag => $posts)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first?"active":"" }}" id="weekly-best-tab-title-{{ $tag }}" data-toggle="tab"
                                           href="#weekly-best-tab-body-{{ $tag }}" role="tab" aria-controls="weekly-best-tab-body-{{ $tag }}" aria-selected="false">{{ $tag }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content" id="myTabContent">


                                @foreach($weeklyBestByTag as $tag => $posts)
                                    @include('pages.posts.partials.tab-body',['tabName'=>'weekly-best-tab-body','tag'=>$tag,'posts'=>$weeklyBestByTag[$tag],'active'=>$loop->first])
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="post-content-area mb-100">
                        <!-- category Area -->
                        <div class="world-category-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">Latest posts</li>

                                @foreach($latestPostsByTag as $tag => $posts)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first?"active":"" }}" id="weekly-best-tab-title-{{ $tag }}" data-toggle="tab"
                                           href="#latest-posts-tab-body-{{ $tag }}" role="tab" aria-controls="latest-posts-tab-body-{{ $tag }}" aria-selected="false">{{ $tag }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content" id="myTabContent">


                                @foreach($latestPostsByTag as $tag => $posts)
                                    @include('pages.posts.partials.tab-body',['tabName'=>'latest-posts-tab-body','tag'=>$tag,'posts'=>$latestPostsByTag[$tag],'active'=>$loop->first])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">

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