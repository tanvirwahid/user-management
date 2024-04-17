<nav class="col-md-2 d-none d-md-block bg-secondary sidebar">
    <div class="sidebar-sticky mt-2">
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profile') ? 'active' : '' }} text-white border-bottom" href="{{route('profile.index')}}">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('password-reset') ? 'active' : '' }} text-white border-bottom" href="{{route('password-reset.index')}}">
                    Reset Password
                </a>
            </li>
            <hr class="dropdown-divider">
        </ul>
    </div>
</nav>