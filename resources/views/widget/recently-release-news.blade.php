
<!-- Widget Area -->
<div class="sidebar-widget-area">
    <h5 class="title">Recently Releases</h5>
    <div class="widget-content">
        @foreach ($recentlyReleases as $release)
            <h5 class="headline">{{ $release->type }} ({{ $release->version }})</h5>
            <p>
                release on
                <span class="post-date">{{ $release->released_at->format('Y-m-d') }}</span>
            </p>
        @endforeach
    </div>
</div>
