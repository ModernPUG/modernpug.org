@extends('common.layout')

@section('title', 'Releases')

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/Programming-Wallpapers-33-2880-x-1800.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Dashboard</h3>
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

                    <div class="title mb-30">
                        <h2>My Blogs</h2>
                    </div>

                    <div class="post-content-area mb-100">
                        <div class="row">
                            @forelse($blogs as $blog)

                                <div class="col-md-6 mb-30">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post  {{ $blog->deleted_at?"bg-danger":"" }}">
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
                                            <div class="small">
                                                피드 갱신: {{ $blog->crawled_at?:"아직 처리되지 않았습니다" }}
                                            </div>
                                            <div>
                                                @if($blog->site_url)
                                                    <a href="{{ $blog->site_url }}" target="_blank">
                                                        {{ $blog->site_url }}
                                                        <i class="fa fa-external-link"></i>
                                                    </a>
                                                @endif
                                            </div>

                                            @if($blog->deleted_at)
                                                <form class="d-inline-block"
                                                      action="{{ route('blogs.restore', $blog->id) }}" method="post">
                                                    @csrf
                                                    @method("PATCH")
                                                    <input type="submit" class="btn btn-info btn-sm" value="복구">
                                                </form>
                                            @else
                                                <a href="{{ route('blogs.edit',[$blog->id]) }}"
                                                   class="btn btn-primary btn-sm">
                                                    수정하기
                                                </a>
                                                <form class="d-inline-block"
                                                      action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="submit" class="btn btn-danger btn-sm" value="삭제">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            @empty
                                등록된 블로그가 없습니다
                            @endforelse

                        </div>
                    </div>
                </div>

                @include('pages.mypage.widget.lnb')

            </div>

        </div>
    </div>

@endsection
