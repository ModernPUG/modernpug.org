@extends('common.layout')

@section('title', 'Recruiting' )

@php
    /**
     * @var \App\Models\Recruit[]|Illuminate\Database\Eloquent\Collection $recruits
     */
@endphp

@section('content')

    @include('pages.recruits.hero-area')

    <section class="section-padding-50">
        <div class="container">


            <h3 class="mb-2">
                <a href="{{ route('recruits.create') }}" class="btn btn-outline-primary pull-right">채용공고 등록하기</a>
                모던 PHP 유저그룹과 함께하는 기업들에 지원해보세요!
            </h3>
            <h6 class="mb-30">성장하는 실력과 행복한 코딩을 위한 첫걸음!</h6>

            <div class="row">

                @forelse($recruits as $recruit)
                    <div class="col-md-6 col-lg-4 mb-30">
                        @include('pages.recruits.card', $recruit)
                    </div>
                @empty
                    <div class="col-lg-12 text-center height-400">
                        <h4>
                            현재 모집중인 채용이 없습니다.
                        </h4>
                    </div>
                @endforelse

            </div>
        </div>
    </section>


    @if(!empty($sponsorUrl) && count($sponsorRecruits))
        <section class="section-padding-50">
            <div class="container">
                <h3 class="mb-2">
                    PHP 개발자 포지션 찾으시나요?
                    <a href="{{ $sponsorUrl }}" target="_blank"
                       class="btn btn-outline-info pull-right">
                        개발자 포지션 모아보기
                    </a>
                </h3>
                <h6 class="mb-30">점핏에서 지원하고 취업축하금도 받으세요</h6>

                <div class="row">
                    @forelse($sponsorRecruits as $sponsorRecruit)
                        <div class="col-md-6 col-lg-4 mb-30">
                            @include('pages.recruits.card', ['recruit'=> $sponsorRecruit])
                        </div>
                    @empty
                        <div class="col-lg-12 text-center height-400">
                            <h4>
                                현재 모집중인 채용이 없습니다.
                            </h4>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

    @endif

@endsection
