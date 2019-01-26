@extends('common.layout')

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(/img/check-class-desk-7103.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>모던 퍼그의 메타블로그에 블로그를 등록합니다</h3>
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
                        <h5>블로그 RSS Url을 입력해주세요</h5>


                        <!-- Contact Form -->
                        <form action="{{ route('blogs.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="group">
                                        <input type="url" name="feed_url" id="feed_url" value="{{ old('feed_url') }}" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your blog feed url</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="comment" id="comment">{{ old('comment') }}</textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your message</label>
                                    </div>
                                </div>
                                <div class="col-12 mb-30">
                                    <button type="submit" class="btn world-btn">register</button>
                                </div>
                                <div class="col-12">

                                    <div>블로그의 정보는 신청하신 Feed 에 있는 정보로 모두 업데이트 됩니다</div>
                                    <div>
                                        수집된 정보는
                                        @foreach(\App\Tag::MANAGED_TAGS as $primaryTag => $tags)
                                            <code class="btn btn-sm btn-outline-dark">{{ $primaryTag }}</code>
                                        @endforeach
                                        의 태그로 분류 되며 자세한 정보는
                                        <a href="{{ route('tags.index') }}" class="text-primary font-bold">
                                            여기
                                        </a>
                                        에서 확인 가능합니다
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