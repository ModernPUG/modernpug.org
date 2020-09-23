
<!-- Widget Area -->
<div class="sidebar-widget-area">
    <h5 class="title">Tags</h5>
    <div class="widget-content">
        @foreach(\App\Models\Tag::MANAGED_TAGS as $primaryTag => $tags)
            <a href="{{ route('posts.search',[$primaryTag]) }}" class="btn btn-default btn-outline-dark btn-sm mb-15">
                {{ $primaryTag }}
            </a>
        @endforeach
    </div>
</div>