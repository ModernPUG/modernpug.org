@extends('common.layout')

@section('title', '포스팅 검색' )

@php
    /**
     * @var string $tagName
     */
@endphp

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/check-class-desk-7103.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 ">
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

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row">


                <div class="col-12 mb-30">
                    <div class="title mb-30">
                        <h1>Managed Tags</h1>
                    </div>

                    <a href="{{ route('posts.search', array_merge(['tag'=>null],\Request::except('page'))) }}"
                       class="btn btn-sm {{ !$tagName ? "btn-primary":"btn-outline-dark" }}">
                        All
                    </a>
                    @foreach($tags as $tag)
                        <a href="{{ route('posts.search',array_merge(\Request::except('page'), ['tag'=>$tag])) }}"
                           class="btn btn-sm {{ $tag == $tagName ? "btn-primary":"btn-outline-dark" }}">
                            {{ $tag }}
                        </a>
                    @endforeach

                    @if($tagName && !in_array($tagName,$tags))
                        <a href="{{ route('posts.search',array_merge(\Request::except('page'), ['tag'=>$tagName])) }}"
                           class="btn btn-sm btn-primary">
                            {{ $tagName }}
                        </a>
                    @endif
                </div>


                <div class="col-12 mb-30">
                    <div class="title mb-30">
                        <h1>Search result</h1>
                    </div>

                    @forelse($posts as $post)
                        @include('partials.blog-2',['post'=>$post])
                    @empty
                        <p>검색 결과가 없습니다</p>
                    @endforelse


                    <div class="pull-right">
                        @if($posts->count())
                            {!! $posts->appends(Request::except('page'))->render() !!}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
