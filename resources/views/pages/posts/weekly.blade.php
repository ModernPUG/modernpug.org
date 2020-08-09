@extends('common.layout')

@section('title', 'Posts' )

@php
    /**
     * @var \App\WeeklyBest[]|\Illuminate\Database\Eloquent\Collection $weeklyBests
     * @var \App\WeeklyBest|null $weeklyBest
     */
@endphp

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/blog-blogger-blogging-4458.jpg);">

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
                                                    <input class="form-control form-control-lg form-control-borderless"
                                                           name="keyword" value="{{ $keyword??'' }}"
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
                            @if($weeklyBest->id)
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">{{ $weeklyBest->year }}년 {{ $weeklyBest->week_no }}주차 주간 인기글</li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                @foreach($weeklyBest->posts as $post)
                                    @include('partials.blog-2',['title_prefix'=>$loop->iteration.". ",'post'=>$post])
                                @endforeach
                            </div>
                            @else
                                <h4 class="text-center">아직 발행된 주간 인기글이 없습니다.</h4>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">

                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">About Modern PHP User Group</h5>
                            <div class="widget-content">

                                @foreach($weeklyBests as $best)
                                    <a href="{{ route('posts.weekly', [$best]) }}"
                                       class="{{ $best->is($weeklyBest)?"active":""  }}">
                                        {{ $best->year }}년
                                        {{ $best->week_no }}주차 인기글
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @include('widget.banner')
                        @include('widget.sponsor')
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
