@extends('common.layout')

@section('title', '배너 관리' )

@php
    /**
     * @var \App\Models\Banner[]|Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator $banners
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
                        <h3>Banners</h3>
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
                        <h2>Banners</h2>
                    </div>

                    <div class="row table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>미리보기</th>
                                <th>제목</th>
                                <th>링크</th>
                                <th>위치</th>
                                <th>게시 시작일</th>
                                <th>게시 종료일</th>
                                <th>등록</th>
                                <th>승인</th>
                                <th>삭제/복구</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($banners as $banner)
                                <tr class="{{ $banner->deleted_at?"bg-danger":"" }}">
                                    <td>
                                        @if($banner->images()->first())
                                            <img
                                                src="{{ asset($banner->images()->first()->file_path??"/img/adult-article-assortment-1496183.jpg") }}"
                                                alt="{{ $banner->title }}" width="50">
                                        @else
                                            없음
                                        @endif
                                    </td>
                                    <td>
                                        {{ $banner->title }}
                                    </td>
                                    <td>
                                        <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                                    </td>
                                    <td>
                                        {{ \App\Models\Banner::POSITIONS[$banner->position] }}
                                    </td>
                                    <td>
                                        {{ $banner->started_at }}
                                    </td>
                                    <td>
                                        {{ $banner->closed_at }}
                                    </td>
                                    <td>
                                        {{ $banner->created_at->format('y-m-d') }}
                                        {{ $banner->create_user->name }}
                                    </td>
                                    <td>
                                        @if($banner->approved_at)
                                            {{ $banner->approved_at->format('y-m-d') }}
                                            {{ $banner->approve_user->name }}

                                            @can('disapprove', $banner)
                                                <div data-url="{{ route('mypage.banners.disapprove',[$banner]) }}"
                                                     class="btn btn-xs btn-warning btn-disallow">승인취소
                                                </div>
                                            @endcan
                                        @else
                                            승인 전
                                            @can('approve', $banner)
                                                <div data-url="{{ route('mypage.banners.approve',[$banner]) }}"
                                                     class="btn btn-xs btn-info btn-allow">승인하기
                                                </div>
                                            @endcan
                                        @endif
                                    </td>
                                    <td>
                                        @if($banner->deleted_at)

                                            {{ $banner->deleted_at->format('y-m-d') }}

                                            <form class="d-inline-block"
                                                  action="{{ route('mypage.banners.restore', $banner->id) }}"
                                                  method="post">
                                                @csrf
                                                @method("PATCH")
                                                <input type="submit" class="btn btn-info btn-sm" value="복구">
                                            </form>
                                        @else
                                            <a href="{{ route('mypage.banners.edit',[$banner->id]) }}"
                                               class="btn btn-primary btn-sm">
                                                수정하기
                                            </a>
                                            <form class="d-inline-block"
                                                  action="{{ route('mypage.banners.destroy', $banner->id) }}"
                                                  method="post">
                                                @csrf
                                                @method("DELETE")
                                                <input type="submit" class="btn btn-danger btn-sm" value="삭제">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        등록된 배너가 없습니다.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                            <tfoot>

                            <tr>
                                <td colspan="8" class="text-center">
                                    @if($banners->count())
                                        {!! $banners->appends(Request::except('page'))->render() !!}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('mypage.banners.create') }}" class="btn btn-sm btn-primary">
                                        등록하기
                                    </a>
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

@push('js')
    <script>
        $('.btn-allow').on('click', function () {
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json'
            }).done(function (result) {
                alert(result.message);
                document.location.reload();
            });
        });
        $('.btn-disallow').on('click', function () {
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'delete',
                dataType: 'json'
            }).done(function (result) {
                alert(result.message);
                document.location.reload();
            });
        });
    </script>
@endpush
