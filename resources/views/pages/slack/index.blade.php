@extends('common.layout')

@section('title', '메타태그 수정' )

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/book-computer-design-326424.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Invite Slack</h3>

                        <p class="mt-50 text-white">
                            Modern PHP User Group 공식 슬랙입니다. <br>
                            슬랙은 초대장을 통해서만 가입 할 수 있으니 아래의 폼을 통해 초대장을 받으세요.
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
                        <h5>초대할 이메일을 입력해주세요</h5>


                        <!-- Contact Form -->
                        <form action="{{ route('slack.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="group">
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your email</label>
                                    </div>
                                </div>
                                <div class="col-12 mb-30">
                                    <button type="submit" class="btn world-btn">Request</button>
                                </div>
                                <div class="col-12">

                                    <div>신청하신 이메일로 초대장이 자동 발송됩니다</div>
                                    <div>
                                        이미 가입하신 분은
                                        <a href="{{ config('modernpug.slack') }}" target="_blank" class="btn btn-xs btn-outline-primary">여기</a>
                                        에서 로그인 하실 수 있습니다
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
