<!-- ========== Sidebar Area ========== -->
<div class="col-12 col-md-8 col-lg-4">
    <div class="post-sidebar-area">

        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <a href="{{ route('mypage.dashboard.index') }}" class="title">Dashboard</a>
        </div>

    @hasanyrole('super-admin|admin|facilitator')
        <!-- Widget Area -->
            <div class="sidebar-widget-area">

                <h5 class="title">Admin</h5>
                <div class="widget-content">
                    @can('user-list')
                    <h5 class="headline"><a href="{{ route('mypage.users.index') }}">Users</a></h5>
                    @endcan
                    @can('role-list')
                    <h5 class="headline"><a href="{{ route('mypage.roles.index') }}">Roles</a></h5>
                    @endcan
                </div>
            </div>
    @endhasrole

    <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">Blog</h5>
            <div class="widget-content">

                <h5 class="headline"><a href="{{ route('mypage.blogs.index') }}">Blogs</a></h5>
                <h5 class="headline"><a href="{{ route('mypage.posts.index') }}">Posts</a></h5>
            </div>

            <h5 class="title">Advertisement</h5>
            <div class="widget-content">
                <h5 class="headline"><a href="{{ route('mypage.banners.index') }}">Banners</a></h5>
            </div>
        </div>

    </div>
</div>
