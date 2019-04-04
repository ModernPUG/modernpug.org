@extends('common.layout')

@section('title', 'About Us' )

@push('css')
    <style>
        .single-blog-post{margin:15px 0;}
        .single-blog-post .post-content{padding:10px 20px;}
    </style>
@endpush

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/book-computer-design-326424.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Modern PHP User Group</h3>

                        <p class="mt-50 text-white">
                            현대적인 PHP 개발에 관심 많은 개발자를 위한 개발자들의 비영리 사용자 모임입니다.<br />
                            매월 1회 정기 모임과 발표를 통해 관심사와 지식을 공유합니다.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->


    @include('pages.aboutus.facilitators')
    @include('pages.aboutus.history')
    @include('pages.aboutus.projects')
@endsection
