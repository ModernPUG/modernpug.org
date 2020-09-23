<?php
/**
 * @var \App\Models\Tag $tag
 * @var \App\Models\Post $post
 * @var bool $active
 * @var string $tabName
 */
?>
<div class="tab-pane {{ $active?"active show":"fade" }}" id="{{ $tabName }}-{{ $tag }}" role="tabpanel">
@foreach($posts as $post)
    @include('partials.blog-2',['post'=>$post])
@endforeach
</div>