@extends('common.layout')

@section('title', 'Recruiting' )

@php
    /**
     * @var \App\Models\Recruit[]|Illuminate\Database\Eloquent\Collection $recruits
     */
@endphp

@section('content')

    @include('pages.recruits.hero-area')

    <section class=" section-padding-50">
        <div class="container">
            <div class="row">

                @forelse($recruits as $recruit)
                    <div class="col-lg-4 col-md-6" style="margin-bottom:20px;">
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
            <div class="row text-right">
                <div class="col-lg-12">
                    <a href="{{ route('recruits.create') }}" class="btn btn- btn-primary">등록</a>
                </div>
            </div>
        </div>
    </section>

@endsection
