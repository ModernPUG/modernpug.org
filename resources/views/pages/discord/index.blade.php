@extends('common.layout')

@section('title', 'Discord 초대장' )

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/book-computer-design-326424.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Discord로 초대합니다!</h3>

                        <p class="mt-50 text-white">
                            Modern PHP User Group 공식 Discord 입니다. <br>
                            Discord는 초대장을 통해서만 가입 할 수 있으니 아래 링크를 통해서 접속해주세요!
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->



    <section class="contact-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="contact-form">
                        <h5>아래의 링크를 통해 접속해주세요!</h5>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ config('modernpug.discord') }}" target="_blank" class="btn btn-default btn-primary">
                                    <i class="fab fa-discord"></i>
                                    바로가기
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
