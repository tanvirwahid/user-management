<nav class="col-md-2 d-none d-md-block bg-secondary sidebar">
    <div class="sidebar-sticky mt-2">
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profile.index') ? 'active' : '' }} text-white border-bottom" href="{{route('profile.index')}}">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white border-bottom" href="#">
                    Sidebar Link 2
                </a>
            </li>
            <hr class="dropdown-divider">
        </ul>
    </div>
</nav>