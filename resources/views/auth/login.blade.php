<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .user-icon {
            max-width: 50px;
            height: auto;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/user-icon.png') }}" alt="User Icon" class="user-icon d-block mx-auto">
                <h4 class="text-center mt-2 mb-4">Login</h4>
                <div class="card ">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @php
                            Session::put('error', null);
                            Session::put('success', null);
                        @endphp

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control mt-1" id="email" name="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="form-group d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-dark btn-sm">Login</button>
                            </div>

                            <div class="form group mt-3">
                                <label>
                                    Don't have an account? <a href="{{ route('registration.form') }}">Sign up</a>
                                </label>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
