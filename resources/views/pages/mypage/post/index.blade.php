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
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/accounting-analytics-apple-572056.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 ">
                    <div class="single-blog-title text-center">
                        <h3>Post</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row">


                <div class="col-12 col-lg-8">
                    <div class="title mb-30">
                        <h2>My Posts</h2>
                    </div>

                    <div class="row">


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
                                        <td class="{{ $post->blog->deleted_at?"del":"" }}">
                                            <a href="{{ $post->blog->site_url }}" target="_blank">
                                                {{ $post->blog->title }}
                                            </a>
                                        </td>
                                    @endif
                                    <td class="{{ $post->deleted_at?"del":"" }}">
                                        <a href="{{ $post->link }}" target="_blank">
                                            {{ $post->title }}
                                        </a>
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

                @include('pages.mypage.widget.lnb')


            </div>
        </div>
    </section>
@endsection
