<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Phone Repair Manager') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        /* .bg-light{
            background-color: '#868e96',
            color: '#ffffff'
        } */

        .navbar-brand {
            font-weight: bold;
        }

        .sidebar {
            background-color: #ffffff;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-right: 1rem;
            min-height: calc(100vh - 100px);
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 1rem;
            color: #858796;
        }

        .list-group-item.active {
            background-color: #4e73df;
            border-color: #4e73df;
            color: white;
        }

        .list-group-item:hover {
            background-color: #f8f9fc;
            color: #5a5c69;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: 1px solid #e3e6f0;
        }

        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">

            @if (session('success'))
                <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 start-50 translate-middle-x p-1"
                    style="z-index: 1080;">
                    <div class="toast align-items-center text-bg-success border-0 show" id="successToast" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="1000"
                        style="font-size: 0.95rem width: 100%;">
                        <div class="d-flex">
                            <div class="toast-body">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current me-2"
                                    fill="none" viewBox="0 0 24 24"
                                    style="width:1em;height:1em;vertical-align:middle;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>

                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-phone"></i> {{ config('app.name', 'Phone Repair Manager') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('repairs.index') }}">Repairs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('inventories.index') }}">Inventory</a>
                            </li> --}}
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a id="loginLink" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a id="registerLink" class="nav-link"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="btn btn-white" id="moonButton">
                                        <i class="bi bi-moon"></i>
                                    </button>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name ?? 'User' }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                    <a class="nav-link text-primary" href="#">
                                        <i class="bi bi-person-circle text-primary"></i> Profile
                                    </a>
                                    <a class="nav-link text-primary" href="{{ route('setting.index') }}">
                                        <i class="bi bi-gear-fill text-primary"></i> Settings
                                    </a>

                                    <a class="dropdown-item text-primary bi bi-box-arrow-right"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __(key: 'Logout') }}

                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li>
                                <button type="button" class="btn btn-white" id="moonButton">
                                    <i class="bi bi-moon"></i>
                                </button>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>



        <main id="main-content" class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
