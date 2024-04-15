<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .user-icon {
            max-width: 50px;
            height: auto;
        }

        .login-text {
            margin-top: 10px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-4">
                <img src="{{ asset('assets/images/user-icon.png') }}" alt="User Icon" class="user-icon d-block mx-auto">
                <!-- User Icon -->
                <h5 class="text-center mt-2 mb-4">Register Your Account</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="form-group col">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control form-control-sm" id="first_name" name="first_name"
                                            type="text" value="{{ old('first_name') }}" required autofocus>
                                        @error('first_name')
                                            <small class="text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control form-control-sm" id="last_name" name="last_name"
                                            value="{{ old('last_name') }}" required autofocus>
                                        @error('last_name')
                                            <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input class="form-control form-control-sm" id="address" name="address"
                                            value="{{ old('address') }}" required autofocus>
                                        @error('address')
                                            <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col">
                                        <label for="phone">Phone</label>
                                        <input type="tel" class="form-control form-control-sm" id="phone"
                                            name="phone" value="{{ old('phone') }}" required autofocus>
                                        @error('phone')
                                            <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="email">Email</label>
                                        <input class="form-control form-control-sm" id="email" name="email"
                                            type="email" value="{{ old('email') }}" required autofocus>
                                        <small id="email-error" class="text-danger text-sm mt-1"></small>
                                        @error('email')
                                            <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                        @enderror

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group mt-3">
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="date_of_birth">Date of Birth:</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" id="date_of_birth"
                                                    name="date_of_birth" type="date"
                                                    value="{{ old('date_of_birth') }}" required autofocus>
                                                @error('date_of_birth')
                                                    <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="row">
                                    <label for="id_file" class="mt-2">Id verification</label>
                                    <input class="form-control form-control-sm m-2" id="id_file" name="id_file"
                                        type="file" value="{{ old('id_file') }}" accept=".pdf" required autofocus>

                                    @error('id_file')
                                        <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control form-control-sm" id="password" name="password"
                                            type="password" required>
                                        @error('password')
                                            <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input class="form-control form-control-sm" id="password_confirmation"
                                            name="password_confirmation" type="password" required>
                                        @error('password_confirmation')
                                            <small class="text-danger text-sm mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center mt-3">
                                    <button type="submit" id="submit-btn" class="btn btn-dark btn-sm">Sign Up</button>
                                </div>

                                <div class="form group mt-3">
                                    <label>
                                        Alreadey have an account? <a href="{{ route('login.form') }}">Login</a>
                                    </label>

                                </div>

                            </form>

                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            let typingTimer;
            let doneTypingInterval = 500;

            $('#email').keyup(function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(checkEmailExists, doneTypingInterval);
            });

            $('#email').blur(function() {
                clearTimeout(typingTimer);
                checkEmailExists();
            });

            function checkEmailExists() {
                var email = $('#email').val();
                $.ajax({
                    url: '/check-email',
                    method: 'GET',
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#email-error').text('Email already exists');
                            $('#submit-btn').prop('disabled', true);
                        } else {
                            $('#email-error').text('');
                            $('#submit-btn').prop('disabled', false);
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>
