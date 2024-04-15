<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verify</title>

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
                <h5 class="text-center mt-2">Verification Code</h5>
                <p class="text-center text-sm mb-4">An unique code has been sent to your email</p>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('verify.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="code">Verification Code</label>
                                <input type="text" class="form-control mt-1" id="code" name="code"
                                    placeholder="verification code">
                                @error('code')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-dark btn-sm">Verify</button>
                            </div>
                            
                            <div class="form group">
                                <label>
                                    Didn't get code? <a href="{{ route('verify.resend') }}">resend</a>
                                </label>
        
                            </div>

                        </form>

                    </div>
                

                    <div class="form group m-3">
                        <form action="{{ route('logout_and_register') }}" method="POST">
                            @csrf
                            <label>
                                Don't have an account?
                                <button type="submit">Sign up</button>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
