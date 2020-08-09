<?php
/**
 * @var \App\Post $post
 * @var string|null $title_prefix
 */
?>
<!-- Single Blog Post -->
<div class="single-blog-post post-style-2 d-flex align-items-center article">
    <!-- Post Thumbnail -->
    <div class="post-thumbnail">
        <a href="{{ route('posts.show',[$post->id]) }}" target="_blank" class="headline">
            <img src="{{ $post->preview->image_url }}" alt="">
        </a>
    </div>
    <!-- Post Content -->
    <div class="post-content">
        <a href="{{ route('posts.show',[$post->id]) }}" target="_blank" class="headline">
            <h5>{{ $title_prefix??"" }}{{ $post->title }}</h5>
            <p>{!! \App\Services\Blog\StripPosts::panel($post->description) !!}</p>

            @if($post->tags->count())
            <p>
                @foreach($post->tags as $tag)
                    <a href="{{ route('posts.search',[$tag->name]) }}" class="btn btn-outline-dark btn-xs">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </p>
            @endif
        </a>
        <!-- Post Meta -->
        <div class="post-meta">
            <p>
                <a target="_blank" href="{{ $post->blog->site_url }}" class="post-author">
                    @if($post->blog->image_url)
                        <img src="{{ $post->blog->image_url }}" alt="" style="width:20px;height:20px;border-radius: 5px;">
                    @endif
                    {{ $post->blog->title }}
                </a>
                on
                <span class="post-date">{{ $post->published_at }}</span>
            </p>
        </div>
    </div>
</div>
