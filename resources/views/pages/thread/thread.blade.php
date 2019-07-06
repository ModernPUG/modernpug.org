@extends('common.layout')

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay" style="padding-top:75px;background-image: url(/img/check-class-desk-7103.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>슬랙에서 발생한 쓰레드를 크롤링하여 보여줍니다</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- category Area -->
                        <div class="world-category-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">Weekly Best</li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1" data-toggle="tab" href="#world-tab-1" role="tab" aria-controls="world-tab-1" aria-selected="true">All</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="tab2" data-toggle="tab" href="#world-tab-2" role="tab" aria-controls="world-tab-2" aria-selected="false">PHP</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="tab3" data-toggle="tab" href="#world-tab-3" role="tab" aria-controls="world-tab-3" aria-selected="false">Laravel</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="tab4" data-toggle="tab" href="#world-tab-4" role="tab" aria-controls="world-tab-4" aria-selected="false">Codeigniter</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="tab5" data-toggle="tab" href="#world-tab-5" role="tab" aria-controls="world-tab-5" aria-selected="false">Linux</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b18.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b19.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b20.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b21.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b23.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b24.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="world-tab-2" role="tabpanel" aria-labelledby="tab2">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b18.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b19.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b20.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b21.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b23.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b24.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="world-tab-3" role="tabpanel" aria-labelledby="tab3">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b18.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b19.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b20.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b21.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b23.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b24.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="world-tab-4" role="tabpanel" aria-labelledby="tab4">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b18.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b19.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b20.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b21.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b23.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b24.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="world-tab-5" role="tabpanel" aria-labelledby="tab5">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b18.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b19.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b20.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b21.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b23.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <img src="/vendor/world/img/blog-img/b24.jpg" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{ route('thread.show', [1]) }}" class="headline">
                                                <h5>PHP 객체의 복제 특성</h5>
                                            </a>
                                            <p>PHP 객체를 다른 변수에 할당(대입)하면, 객체 자체가 메모리 복제되어 새로운 변수에 할당되는 것이 아니라, 원본...</p>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <p><a href="#" class="post-author">Appkr.memo(new Life)</a> on <a href="#" class="post-date">2018-11-03</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">

                        @include('widget.about')
                        @include('widget.connect')
                        @include('widget.banner')
                        @include('widget.sponsor')
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
