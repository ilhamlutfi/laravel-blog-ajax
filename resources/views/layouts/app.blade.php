<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- verif adsense --}}
    <meta name="google-adsense-account" content="ca-pub-3010068237307801">

    <title>@yield('title') - Admin Blog</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    @stack('css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                            <li class="nav-item btn btn-sm btn-light">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-chart-bar"></i>
                                    Dashboard</a>
                            </li>

                            <li
                                class="nav-item btn btn-sm btn-light {{ request()->is('admin/articles*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.articles.index') }}"><i
                                        class="fa fa-file-alt"></i> Article</a>
                            </li>

                            @if (auth()->user()->role == 'owner')
                                <li
                                    class="nav-item btn btn-sm btn-light {{ request()->is('admin/categories*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.categories.index') }}"><i
                                            class="fa fa-list"></i>
                                        Categories</a>
                                </li>

                                <li
                                    class="nav-item btn btn-sm btn-light {{ request()->is('admin/tags*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.tags.index') }}"><i class="fa fa-tag"></i>
                                        Tag</a>
                                </li>
                            @endif

                            @if (auth()->user()->role == 'owner')
                                <li class="nav-item btn btn-sm btn-light">
                                    <a class="nav-link" href="{{ route('admin.writers.index') }}"><i
                                            class="fa fa-users"></i> Writer</a>
                                </li>
                            @endif

                            <li class="nav-item btn btn-sm btn-light">
                                <a class="nav-link" href="{{ url('/') }}" target="_blank"><i
                                        class="fa fa-arrow-alt-circle-up"></i> Homepage</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @stack('js')
    </div>
</body>

</html>
