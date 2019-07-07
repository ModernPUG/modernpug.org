@extends('common.layout')

@section('title', '블로그 관리' )

@php
    /**
     * @var App\Blog[]|Illuminate\Database\Eloquent\Collection $blogs
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
                        <h3>Blog</h3>
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
                        <h2>My Blogs</h2>
                    </div>

                    <div class="row table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>미리보기</th>
                                    <th>feed_url</th>
                                    <th>제목</th>
                                    <th>등록된 글</th>
                                    <th>최종수집일</th>
                                    <th>등록일</th>
                                    <th>삭제일</th>
                                    <th>삭제/복구</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($blogs as $blog)
                                    <tr class="{{ $blog->deleted_at?"bg-danger":"" }}">

                                        <td>
                                            @if($blog->image_url)
                                                <img
                                                    src="{{ $blog->image_url??"/img/adult-article-assortment-1496183.jpg" }}"
                                                    alt="{{ $blog->title }}" width="50">
                                            @else
                                                없음
                                            @endif
                                        </td>
                                        <td>
                                            {{ $blog->feed_url }}
                                        </td>
                                        <td>
                                            {{ $blog->title }}
                                        </td>
                                        <td>
                                            {{ number_format($blog->posts->count()) }}
                                        </td>
                                        <td>
                                            {{ $blog->crawled_at?$blog->crawled_at->format('y-m-d'):'' }}
                                        </td>
                                        <td>
                                            {{ $blog->created_at->format('y-m-d') }}
                                        </td>
                                        <td>
                                            {{ $blog->deleted_at?$blog->deleted_at->format('y-m-d'):'' }}
                                        </td>
                                        <td>
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
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            검색 결과가 없습니다
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>

                                <tfoot>

                                <tr>
                                    <td colspan="8" class="text-center">
                                        @if($blogs->count())
                                            {!! $blogs->appends(Request::except('page'))->render() !!}
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
