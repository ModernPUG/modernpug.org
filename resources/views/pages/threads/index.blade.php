@extends('common.layout')

@section('title', 'Posts' )

@php
    /**
     * @var \App\Models\DiscordThread[]|Illuminate\Database\Eloquent\Collection|Illuminate\Contracts\Pagination\LengthAwarePaginator $threads
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
                        <form action="{{ route('threads.index') }}">

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
                                                           name="keyword" value="{{ request()->get('keyword') }}"
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

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>주의사항!</strong>
                        모든 질문과 답변은 디스코드 질문하기 채널에서 진행됩니다
                        <hr>
                        질문을 하고싶거나 이미 달린 질문의 답변이 궁금하신분은 디스코드로 오세요!
                        <a href="{{ config('modernpug.discord') }}" target="_blank"
                           class="btn btn-xs btn-outline-secondary">
                            <i class="fab fa-discord"></i>
                            디스코드 초대장 바로가기
                        </a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="post-content-area mb-100">
                        @forelse($threads as $thread)
                            <!-- Single Blog Post -->
                            <div class="single-blog-post article p-2">
                                <!-- Post Content -->
                                <div class="p-2">
                                    <a href="{{ $thread->toUrl() }}" target="_blank" class="headline">
                                        <h6>
                                            @if($thread->archived)
                                                <span class="text-danger">
                                                    [완료]
                                                </span>
                                            @else
                                                <span class="text-info">
                                                    [진행중]
                                                </span>
                                            @endif
                                            {{ $thread->name }}
                                            <span class="btn btn-outline-secondary btn-xs">
                                                <i class="fa fa-user"></i>
                                                {{ number_format($thread->member_count) }}
                                            </span>
                                            <span class="btn btn-outline-secondary btn-xs">
                                                <i class="fa fa-comment"></i>
                                                {{ number_format($thread->message_count) }}
                                            </span>
                                        </h6>
                                    </a>
                                </div>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p>
                                        @foreach($thread->tags as $tag)
                                            <span class="btn btn-outline-dark btn-xs">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                        <span
                                            class="post-date pull-right">{{ $thread->thread_started_at->format('Y-m-d') }}</span>
                                    </p>
                                </div>
                            </div>

                        @empty
                            <h4>검색 결과가 없습니다</h4>
                        @endforelse


                        <div class="d-flex justify-content-center mt-5">
                            @if($threads->count())
                                {!! $threads->appends(Request::except('page'))->render() !!}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">

                        @include('widget.about')
                        @include('widget.connect')
                        {{--@include('widget.banner')--}}
                        @include('widget.sponsor')
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
