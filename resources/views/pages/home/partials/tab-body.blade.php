<?php
/**
 * @var \App\Tag $tag
 * @var \App\Post $post
 * @var bool $active
 * @var string $tabName
 */
?>
<div class="tab-pane {{ $active?"active show":"fade" }}" id="{{ $tabName }}-{{ $tag }}" role="tabpanel">
    <div class="row">
        <div class="col-12 col-md-6">

            @foreach($posts as $post)
                @if(!$loop->first)
                    @continue
                @endif

                @include('partials.blog',['post'=>$post])
            @endforeach
        </div>

        <div class="col-12 col-md-6">


            @foreach($posts as $post)
                @if($loop->first)
                    @continue
                @endif

                @include('partials.blog-2-non-body',['post'=>$post])
            @endforeach


        </div>
    </div>
</div>