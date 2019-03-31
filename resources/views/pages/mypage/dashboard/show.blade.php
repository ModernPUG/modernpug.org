@extends('common.layout')

@section('title', '포스팅 검색' )

@php
/**
 * @var App\Blog[]|Illuminate\Database\Eloquent\Collection $blogs
 * @var App\Post[]|Illuminate\Database\Eloquent\Collection $posts
 */
@endphp

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/accounting-analytics-apple-572056.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 ">
                    <div class="single-blog-title text-center">
                        Dashboard
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
                        <h1>My Blogs</h1>
                    </div>

                    <div class="row">
                        @forelse($blogs as $blog)

                            <div class="col-md-3 mb-30">
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

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>미리보기</th>
                            @if(count($blogs))
                                <th>블로그</th>
                            @endif
                            <th>제목</th>
                            <th>조회수</th>
                            <th>발행일</th>
                            <th>삭제일</th>
                            <th>삭제/복구</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($posts as $post)
                            <tr>

                                <td>
                                    @if($post->preview->image_url)
                                        <img src="{{ $post->preview->image_url }}" alt="" width="50">
                                    @else
                                        없음
                                    @endif
                                </td>

                                @if(count($blogs))
                                    <td>
                                        @if($post->blog)
                                            <del>

                                                {{ $post->blog->title }}
                                            </del>
                                        @else
                                            {{ $post->blog }}
                                        @endif
                                    </td>
                                @endif
                                <td>

                                    @if($post->deleted_at)
                                        <del>
                                            {{ $post->title }}
                                        </del>
                                    @else
                                        <a href="{{ $post->link }}" target="_blank">
                                            {{ $post->title }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ number_format($post->viewcount_count) }}
                                </td>
                                <td>
                                    {{ $post->published_at }}
                                </td>
                                <td>
                                    {{ $post->deleted_at?$post->deleted_at->format('y-m-d'):'' }}
                                </td>
                                <td>
                                    @if($post->deleted_at)
                                        <form action="{{ route('posts.restore', $post->id) }}" method="post">
                                            @csrf
                                            @method("PATCH")
                                            <input type="submit" class="btn btn-info btn-sm" value="복구">
                                        </form>
                                    @else
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" class="btn btn-danger btn-sm" value="삭제">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    검색 결과가 없습니다
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                        <tfoot>

                        <tr>
                            <td colspan="7" class="text-center">
                                @if($posts->count())
                                    {!! $posts->appends(Request::except('page'))->render() !!}
                                @endif
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                </div>

            </div>
        </div>
    </section>
@endsection