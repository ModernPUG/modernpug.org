@extends('common.layout')

@section('title', '포인트 관리' )

@php
    /**
     * @var \App\Models\Point[]|Illuminate\Database\Eloquent\Collection $points
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
                        <h3>Point</h3>
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
                        <h2>My Points</h2>
                    </div>

                    <div class="row table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>구분</th>
                                <th>포인트</th>
                                <th>연관 모델</th>
                                <th>발행</th>
                                <th>획득</th>
                                <th>등록일</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($points as $point)
                                <tr>

                                    <td>
                                        {{ $point->type }}
                                    </td>
                                    <td>
                                        {{ number_format($point->point) }}
                                    </td>
                                    <td>
                                        @if($point->point_type)
                                            {{ $point->point_type }}
                                            /
                                            {{ $point->point_id }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $point->give_user->name??"-" }}
                                    </td>
                                    <td>
                                        {{ $point->receive_user->name }}
                                    </td>
                                    <td>
                                        {{ $point->created_at }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        검색 결과가 없습니다
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                            <tfoot>

                            <tr>
                                <td colspan="6" class="text-center">
                                    @if($points->count())
                                        {!! $points->appends(Request::except('page'))->render() !!}
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
