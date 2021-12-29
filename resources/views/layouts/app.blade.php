<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videoPlayer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/userVideos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    {{-- VideoJS CSS --}}
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/3c7b83a092.js" crossorigin="anonymous"></script>


</head>

<body>
    {{-- Data Test @dd($categories) --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/hoverPlay.js') }}"></script>

    <div id="app">
        {{-- NAVBAR --}}
        <nav id="nav" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="nav-container">
                <a id="nav-logo" class="navbar-brand" href="{{ url('/home') }}">
                    {{-- Mega
                    <img id="nav-logo-img" src="{{ asset('assets/img/logo_sorbonne.png') }}" alt="S">
                    tream --}}
                    <div id="logo">
                        <img src="{{ asset('assets/img/main_logo.svg') }}" alt="MegaStream">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    {{-- @if (Route::currentRouteName() != 'welcome' || Route::currentRouteName() != 'login') --}}
                    @if (Auth::check())
                        {{-- @dd($videoCount) --}}
                        <div class="nav-searchbar">
                            <form action="{{ url('search') }}" method="GET" id="search-form"
                                class="form-inline my-2 my-lg-0 searchbar-form">
                                @csrf

                                <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                    aria-label="Search" name="text">
                                <select class="custom-select custom-select-md mr-sm-2" name="category">
                                    <option selected disabled>Categorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li> --}}
                                <a class="btn btn-auth btn-outline-light" href="{{ route('login') }}">Connexion</a>
                            @endif

                            @if (Route::has('register'))
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> --}}
                                <a class="btn btn-auth btn-outline-light" href="{{ route('register') }}">Inscription</a>
                            @endif
                        @else
                            <a class="btn btn-auth btn-outline-light"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
                                <i class="fas fa-sign-out-alt">
                                    {{-- {{ __('Logout') }} --}}
                                </i>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </a>



                            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        >
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="main-app">
            {{-- NAVIGATION UTILISATEUR (side nav) --}}
            @auth
                @if (Route::currentRouteName() != 'welcome' || Route::currentRouteName() != 'login' || Route::currentRouteName() != 'register')
                    <div id="side-nav">
                        <div class="user-component">
                            <div class="triggerNav-container">
                                {{-- TRIGGERNAV
                                    <i onclick="triggerSideNav()" class="far fa-square" id="triggerChevron"></i> --}}
                            </div>
                            <div class="user-picture">
                                <i class="fas fa-user-astronaut"></i>
                                <h5 class="username">
                                    {{ Auth::user()->name }}
                                </h5>
                                {{-- TO DO                      
                                    <div class="videoCount">

                                    </div> --}}
                            </div>
                            <div class="site-videos side-menu">
                                <a href="/home" class="btn btn-light">
                                    Recommandations
                                </a>

                            </div>
                            <div class="user-videos side-menu">
                                <a href="/user/{{ auth()->user()->name }}" class="btn btn-light">
                                    Mes Vidéos
                                </a>
                            </div>

                            <div class="user-upload side-menu">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#uploadModal">
                                    Upload
                                </button>
                            </div>



                        </div>

                        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
                            aria-labelledby="uploadModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="upload-component">
                                            <form id="upload-form" action="{{ url('uploadVideo') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-upload-title">
                                                    <div class="form-upload-logo">
                                                        <img src="{{ asset('assets/img/main_logo_filled.svg') }}"
                                                            alt="MegaStream">
                                                    </div>
                                                    <h3>Upload</h3>
                                                </div>

                                                <input type="text" class="form-control upload-input" id="titre"
                                                    class="upload-input" placeholder="Titre" name="title" required>


                                                <textarea class="form-control upload-input" name="description"
                                                    id="description" cols="30" rows="4" placeholder="Description"
                                                    required></textarea>

                                                <div class="file-input-wrapper upload-input">
                                                    <i class="fas fa-file-video"></i>
                                                    <input class="form-control" id="file" type="file" name="file"
                                                        required>
                                                </div>

                                                <select class="custom-select custom-select-sm mb-3 upload-input"
                                                    aria-label="Default select example" name="videoCategory">
                                                    <option selected disabled>Selectionnez une Catégories</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <input class="btn btn-dark submit-upload" type="submit">

                                                <hr />

                                                <div class="form-group">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                                            role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                            aria-valuemax="100" style="width: 0%"></div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endauth
            <div id="main-wrapper">
                {{-- Les views sont ajouter ici --}}
                @yield('content')
            </div>

        </main>
    </div>

</body>

</html>
