@extends('common.layout')

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/book-computer-design-326424.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>Invite Slack</h3>
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
                                    <button type="submit" class="btn world-btn">register</button>
                                </div>
                                <div class="col-12">

                                    <div>신청하신 이메일로 초대장이 자동 발송됩니다</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection