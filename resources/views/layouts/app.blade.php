<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveEpic') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->

</head>
<body style="background: url('{{ asset('images/bg.jpg') }}') no-repeat center center fixed; background-size: cover;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand fs-4 fw-bold text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'DriveEpic') }}
                </a>
                <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold text-white" href="{{ url('/') }}"> Accueil </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold text-white" href="{{ route('cars.index') }}"> Liste des Voitures </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold text-white" href="{{ route('reservations.index') }}"> Historique </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link fs-5 fw-bold text-white" href="{{ route('login') }}"> Se connecter </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fs-5 fw-bold text-white" href="{{ route('register') }}"> S'inscrire </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link fs-5 fw-bold text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item fs-6 fw-bold" href="{{ route('auth.profile.index') }}">
                                        Mon Profil
                                    </a>
                                    <a class="dropdown-item fs-6 fw-bold" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        Se déconnecter
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
    </div>
</body>
</html>
