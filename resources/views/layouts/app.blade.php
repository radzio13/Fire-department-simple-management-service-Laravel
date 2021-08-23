<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Straż pożarna', 'Straż pożarna') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Straż pożarna', 'Straż pożarna') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj się') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Zarejestruj się') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj się') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth

        <div class="container">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3 py-4">
                    <ul class="list-group">
                        @if(auth()->user()->isAdmin())
                          <li class="list-group-item">
                            <a href="{{route('users.index')}}">Użytkownicy</a>
                        </li>
                        @endif
                         <li
                     class="list-group-item">
                            <a href="{{route('posts.index')}}">Posty</a>
                        </li>
                            @if(auth()->user()->isAdmin())
                         <li class="list-group-item">
                            <a href="{{ route('categories.index')}}">Kategorie</a>
                        </li>
                          <li class="list-group-item">
                            <a href="{{ route('trashed.index')}}">Usunięte posty</a>
                        </li>
                         <li class="list-group-item">
                            <a href="{{ route('tags.index')}}">Tagi</a>
                        </li>
                            @endif
                           <li
                     class="list-group-item">
                            <a href="{{route('users.edit', Auth()->user()->id)}}">Profil</a>
                        </li>
                            <li class="list-group-item">
                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj się') }}
                                    </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8">
                     <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        @else
        <main class="py-4">
            @yield('content')
        </main>
        @endauth

        @yield('scripts')

    </div>
</body>
</html>
