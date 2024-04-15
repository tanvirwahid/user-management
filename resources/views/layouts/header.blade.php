<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container d-flex justify-content-between">
        <div class="navbar-brand">
            User Portal
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown mx-3">
                <button class="btn btn-transparent text-white dropdown-toggle" type="button"
                    id="dropdownMenuButton">
                    {{ Auth::user()->first_name }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>