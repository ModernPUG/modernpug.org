<!-- ========== Sidebar Area ========== -->
<div class="col-12 col-md-8 col-lg-4">
    <div class="post-sidebar-area">

        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <a href="{{ route('mypage.dashboard.index') }}" class="title">Dashboard</a>
        </div>

    @can('user-list')
        <!-- Widget Area -->
            <div class="sidebar-widget-area">

                <h5 class="title">Admin</h5>
                <div class="widget-content">
                    <h5 class="headline"><a href="{{ route('mypage.users.index') }}">Users</a></h5>
                </div>
            </div>
    @endcan

    <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <a href="{{ route('mypage.dashboard.index') }}" class="title">Blog</a>
            <div class="widget-content">

                <h5 class="headline"><a href="{{ route('mypage.blogs.index') }}">Blogs</a></h5>
                <h5 class="headline"><a href="{{ route('mypage.posts.index') }}">Posts</a></h5>
            </div>
        </div>

    </div>
</div>
