<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container d-flex justify-content-between">
        <div class="navbar-brand">
            User Portal
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown mx-3">
                <button class="btn btn-transparent text-white dropdown-toggle" type="button" id="dropdownMenuButton">
                    {{ Auth::user()->first_name }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('password-reset.index')}}">Change Password</a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-transparent" type="submit">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
