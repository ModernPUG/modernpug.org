<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarBlogDropdown" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            About Us
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarBlogDropdown">
            <a class="dropdown-item" href="{{ route('modernpug.aboutus') }}">About Us</a>
            <a class="dropdown-item" href="{{ route('modernpug.logo') }}">Logo</a>
            <a class="dropdown-item" href="{{ route('sponsors.index') }}">Sponsors</a>
        </div>
    </li>


    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarBlogDropdown" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Meta Blog
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarBlogDropdown">
            <a class="dropdown-item" href="{{ route('blogs.index') }}">Blog</a>
            <a class="dropdown-item" href="{{ route('posts.index') }}">Post</a>
            <a class="dropdown-item" href="{{ route('posts.search') }}">Search</a>
            <a class="dropdown-item" href="{{ route('posts.weekly') }}">Weekly Best</a>
            <a class="dropdown-item" href="{{ route('tags.index') }}">Tag</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="https://wiki.modernpug.org/questions"
           target="_blank">
            QNA & WIKI
            <i class="fa fa-external-link"></i>
        </a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            Projects
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="http://modernpug.github.io/php-the-right-way/"
               target="_blank">
                PHP The Right Way
                <i class="fa fa-external-link"></i>
            </a>
            <a class="dropdown-item"
               href="https://designpatternsphpko.readthedocs.io/ko/latest/" target="_blank">
                Design Patterns PHP
                <i class="fa fa-external-link"></i>
            </a>
            <a class="dropdown-item" href="https://github.com/ModernPUG/meetup" target="_blank">
                정기모임 발표자료
                <i class="fa fa-external-link"></i>
            </a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('news.releases.index') }}">Releases</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('recruits.index') }}">Recruits</a>
    </li>


    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown"
               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->name }}님 환영합니다
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('mypage.dashboard.index') }}">Dashboard</a>
                <a class="dropdown-item" href="{{ route('mypage.profile.show') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    @endauth
    @guest
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Login / Register
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
            </div>
        </li>
    @endguest

</ul>