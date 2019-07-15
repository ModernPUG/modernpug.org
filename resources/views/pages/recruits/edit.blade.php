@extends('common.layout')

@section('title', '채용공고 수정' )


@php
    /**
     * @var App\Recruit $recruit
     */
@endphp

@section('content')

    @include('pages.recruits.hero-area')


    <section class="contact-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="contact-form">
                        <h5>채용공고를 수정합니다</h5>


                        <!-- Contact Form -->
                        <form action="{{ route('recruits.update', ['id'=>$recruit->id]) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="row">
                                @include('pages.recruits.form')
                                <div class="col-12 mb-30">
                                    <button type="submit" class="btn btn-primary">수정</button>
                                    <a href="{{ route('recruits.index') }}" class="btn btn-outline-dark">목록으로</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
