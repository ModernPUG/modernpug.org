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
                <img
                    src="{{ asset($banner->images()->first()->file_path??"/img/adult-article-assortment-1496183.jpg") }}"
                    title="{{ $banner->title }}">
            </a>
        @endforeach

    </div>
</div>
