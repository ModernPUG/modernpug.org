@php
    /**
     * @var \App\Models\Banner[] $banners
     */
@endphp

<!-- Widget Area -->
<div class="sidebar-widget-area banner">
    <h5 class="title">Recruit</h5>
    <div class="widget-content">

        @foreach($banners as $banner)
            <a class="single-blog-post post-style-2 d-flex align-items-center widget-post" href="{{ $banner->url }}"
               target="_blank">
                <img src="{{ asset($banner->images()->first()->file_path??"/img/adult-article-assortment-1496183.jpg") }}" title="{{ $banner->title }}">
            </a>
        @endforeach

        <a class="single-blog-post post-style-2 d-flex align-items-center widget-post"
           href="https://recruit.brich.co.kr/" target="_blank">
            <img src="/img/recruit/brich_banner.jpg">
        </a>


        <a class="single-blog-post post-style-2 d-flex align-items-center widget-post"
           href="http://www.jobkorea.co.kr/Recruit/GI_Read/29823090?Oem_Code=C1" target="_blank">
            <img src="/img/recruit/airtel_banner.png">
        </a>


        <a class="single-blog-post post-style-2 d-flex align-items-center widget-post"
           href="http://www.saramin.co.kr/zf_user/jobs/view?rec_idx=37009515&view_type=etc" target="_blank">
            <img src="/img/recruit/carmore-1.png">
        </a>


    </div>
</div>
