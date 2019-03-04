@extends('common.layout')

@section('title', 'Logos' )

@push('css')
    <style>
        .single-blog-post {
            margin: 15px 0;
        }

        .single-blog-post .post-content {
            padding: 10px 20px;
        }
    </style>
@endpush

@section('content')

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay"
         style="background-image: url(/img/coffee-smartphone-desk-pen.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="text-center text-white mt-50">
                        <h2 class="text-white">Modern PHP User Group Logos</h2>

                        <p class="mt-30 text-white">
                            심플한 코끼리 옆모습과 살짝 뒤돌아보는 뒷모습이 공존하는 심볼입니다.
                            <br>
                            선두에서 당당히 그룹을 이끌며 살뜰히 뒤돌아보며 무리를 챙기는 코끼리의 이미지를 상상해 주세요 <./.>
                        </p>
                        <a class="mt-30 btn btn-info" href="/logo.zip" rel="noopener" target="_blank">Download</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->

    <section class="contact-area mt-100 text-center">
        <div class="container">
            <div class="row mb-50">

                <div class="col-12 col-md-4 col-lg-4 mb-50">
                    <div class="d-flex align-items-center" style="border: 1px solid #eee;height:300px;">
                        <img src="/img/logo/logo_01.svg" alt="Modern PHP User Group Logo">
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-50">
                    <div class="d-flex align-items-center" style="border: 1px solid #eee;height:300px;">
                        <img src="/img/logo/logo_02.svg" alt="Modern PHP User Group Logo">
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-50">
                    <div class="d-flex align-items-center" style="border: 1px solid #eee;height:300px;">
                        <img src="/img/logo/logo_03.svg" alt="Modern PHP User Group Logo">
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-12 col-sm-6 mb-50">
                    <h3>해도 괜찮아요</h3>
                    <ul>
                        <li>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            모던퍼그의 링크를 걸기 위해서 사용
                        </li>
                        <li>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            모던 퍼그의 관련 소식을 전하는 게시글에 사용
                        </li>
                        <li>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            색상, 폰트의 수정
                        </li>
                        <li>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            브랜드의 가치를 해치지 않는 2차 창작
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 mb-50">
                    <h3>하면 안되요</h3>
                    <ul>
                        <li>
                            <i class="fa fa-times" aria-hidden="true"></i>
                            비공식 사이트에서 사용자가 공식 사이트로 착각을 유도하는 것
                        </li>
                        <li>
                            <i class="fa fa-times" aria-hidden="true"></i>
                            모던퍼그의 가치 및 브랜드 이미지를 손상 시킬 수 있는 것
                        </li>
                    </ul>
                </div>


                <div class="col-12">
                    <h3>Design By</h3>
                    <div class="mt-2">
                        이 디자인은
                        <a class="text-primary" href="https://www.facebook.com/groovoo" target="_blank">Snow Lee</a>
                        님의 재능기부로 제작되었습니다.
                        <br>
                        도움에 다시한번 감사드립니다.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="regular-page-wrap section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">
                    <h3>Examples</h3>
                    <div class="mt-2">
                        로고는 아래와 같이 사용/응용 할 수 있습니다
                    </div>
                    <div class="page-content">

                        <img src="/img/logo/goods.jpg" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
