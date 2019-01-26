<?php
/**
 * @var \App\Tag $tag
 * @var \App\Post $post
 * @var bool $active
 * @var string $tabName
 */
?>
<div class="tab-pane {{ $active?"active show":"fade" }}" id="{{ $tabName }}-{{ $tag }}" role="tabpanel">
@foreach($posts as $post)
    @include('partials.blog-2',['post'=>$post])
@endforeach
</div>