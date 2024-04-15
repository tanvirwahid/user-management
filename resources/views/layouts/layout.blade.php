<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .btn-transparent {
            background-color: transparent;
            border: none;
            color: inherit;
            padding: 0;
        }

        html, body, #app {
            height: 100%;
        }

        #app {
            display: flex;
            flex-direction: column;
        }
        .sidebar {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        main {
            flex-grow: 1;
        }
    </style>

</head>

<body>
    <div id="app">
        <!-- Header -->

        @include('layouts.header')

        <!-- Main Content -->
        <main role="main" class="flex-grow-1">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    @include('layouts.sidebar')
                   
                    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
                        @yield('content')
                    </main>

                </div>
            </div>
        </main>
        
       @include('layouts.footer')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').on('click', function() {
                $('.dropdown-menu').toggle();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                }
            });
        });
    </script>

</body>

</html>